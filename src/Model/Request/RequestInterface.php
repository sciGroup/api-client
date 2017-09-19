<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 19.09.17 14:26.
 */

namespace Sci\API\Client\Model\Request;

interface RequestInterface
{
    public function getQuery(): string;
}