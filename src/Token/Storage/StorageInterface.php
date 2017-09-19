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
     * @param mixed $value The value to serialize
     */
    public function set(string $name, $value);

    /**
     * @param string $name
     * @return mixed|null Unserialized value
     */
    public function get(string $name);
}