<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 18.09.17 19:18.
 */

namespace Sci\API\Client\Token\Storage;

/**
 * Append only file storage (without compaction).
 */
class FileStorage implements StorageInterface
{
    /**
     * @var string
     */
    private $filePath;

    public function __construct(string $filePath)
    {
        if (!file_exists($filePath)) {
            throw new \InvalidArgumentException(sprintf('File %s does not exist!', $filePath));
        }

        $this->filePath = $filePath;
    }

    public function set(string $name, string $value, int $validUntil)
    {
        file_put_contents($this->filePath, $name . ':' . serialize(['value' => $value, 'valid_until' => $validUntil]), FILE_APPEND | LOCK_EX);
    }

    public function get(string $name)
    {
        if ($f = fopen($this->filePath, 'r')) {
            fseek($f, 0, SEEK_END);

            function moveOneStepBack(&$f)
            {
                if (ftell($f) > 0) {
                    fseek($f, -1, SEEK_CUR);

                    return true;
                } else {
                    return false;
                }
            }

            function readNotSeek(&$f, $length)
            {
                $r = fread($f, $length);
                fseek($f, -$length, SEEK_CUR);

                return $r;
            }

            while (ftell($f) > 0) {
                $newLine = false;
                $charCounter = 0;

                while (!$newLine && moveOneStepBack($f)) {
                    if (readNotSeek($f, 1) == "\n") $newLine = true;
                    $charCounter++;
                }

                if ($charCounter > 1) {
                    if (!$newLine) echo "\n";

                    $line = readNotSeek($f, $charCounter);
                    list($key, $value) = explode(':', $line);
                    if ($key == $name) {
                        $value = unserialize($value);
                        if ($value['valid_until'] > time()) {
                            return $value['value'];
                        } else {
                            return null;
                        }
                    }
                }

            }

            fclose($f);
        }

        return null;
    }
}