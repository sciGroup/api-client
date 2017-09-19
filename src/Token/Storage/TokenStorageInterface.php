<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 18.09.17 18:42.
 */

namespace Sci\API\Client\Token\Storage;

interface TokenStorageInterface
{
    /**
     * @param mixed $value The value to serialize
     */
    public function set($value);

    /**
     * @return mixed|null Unserialized value
     */
    public function get();
}