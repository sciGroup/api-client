<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 21.09.17 11:02.
 */

namespace Sci\API\Client\Model\ResponseTransformer;

use Psr\Http\Message\ResponseInterface;
use Sci\API\Client\Model\Wrapper\EventSearchResponseWrapper;

class EventSearchResponseTransformer implements ResponseTransformerInterface
{
    /**
     * @param ResponseInterface $response
     * @return EventSearchResponseWrapper
     */
    public function transform(ResponseInterface $response)
    {
        $r = json_decode($response->getBody(), true);

        return new EventSearchResponseWrapper($r['hits'], $r['strict'], []);
    }
}