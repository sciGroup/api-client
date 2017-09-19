<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 18.09.17 18:42.
 */

namespace Sci\API\Client\Token\Storage;

interface StorageInterface
{
    /**
     * @param string $name
     * @param string $value
     * @param int $validUntil Unix timestamp
     */
    public function set(string $name, string $value, int $validUntil);

    /**
     * @param string $name
     * @return string|null
     */
    public function get(string $name);
}