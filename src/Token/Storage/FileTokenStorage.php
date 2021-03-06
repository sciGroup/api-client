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
        $this->filePath = $filePath;
    }

    public function set($value)
    {
        file_put_contents($this->filePath, serialize($value), LOCK_EX);
    }

    public function get()
    {
        if (!file_exists($this->filePath)) {
            return null;
        }

        if ($data = file_get_contents($this->filePath)) {
            return unserialize($data);
        }

        return null;
    }
}