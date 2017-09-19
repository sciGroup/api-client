<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 18.09.17 19:18.
 */

namespace Sci\API\Client\Token\Storage;

/**
 * Append only file storage (without compaction).
 */
class FileTokenStorage implements TokenStorageInterface
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

    public function set($value)
    {
        file_put_contents($this->filePath, serialize($value)."\n", FILE_APPEND | LOCK_EX);
    }

    public function get()
    {
        $fp = fopen($this->filePath, 'r');
        fseek($fp, -1, SEEK_END);
        $pos = ftell($fp);
        $lastLine = null;
        while((($c = fgetc($fp)) != "\n") && ($pos > 0)) {
            $lastLine = $c.$lastLine;
            fseek($fp, $pos--);
        }
        fclose($fp);

        if ($lastLine) {
            return unserialize($lastLine);
        }

        return $lastLine;
    }
}