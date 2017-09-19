<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 19.09.17 10:55.
 */

namespace Sci\API\Client\HTTPTransport;

use Psr\Http\Message\ResponseInterface;

interface HTTPTransportInterface
{
    public function get(string $URI): ResponseInterface;
}