<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 21.09.17 11:04.
 */

namespace Sci\API\Client\Model\ResponseTransformer;

use Psr\Http\Message\ResponseInterface;

interface ResponseTransformerInterface
{
    public function transform(ResponseInterface $response);
}