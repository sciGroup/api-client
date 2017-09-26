<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 18.09.17 18:45.
 */

namespace Sci\API\Client;

use Sci\API\Client\HTTPTransport\HTTPTransportInterface;
use Sci\API\Client\Model\Request\Event\EventSearchRequest;
use Sci\API\Client\Model\ResponseTransformer\EventSearchResponseTransformer;
use Sci\API\Client\Model\Wrapper\EventSearchResponseWrapper;
use Sci\API\Client\Token\OAuthAuthenticator;

class Client
{
    /**
     * @var string Without trailing slash
     */
    private $basePath;

    /**
     * @var OAuthAuthenticator
     */
    private $authenticator;

    /**
     * @var HTTPTransportInterface
     */
    private $transport;

    public function __construct(string $basePath, OAuthAuthenticator $authenticator, HTTPTransportInterface $transport)
    {
        $this->basePath = $basePath;
        $this->authenticator = $authenticator;
        $this->transport = $transport;
    }

    public function eventSearch(EventSearchRequest $request): EventSearchResponseWrapper
    {
        $rawResponse = $this->transport->get($request->getQueryString($this->basePath).'&access_token='.$this->authenticator->getToken());
        $transformer = new EventSearchResponseTransformer();

        return $transformer->transform($rawResponse);
    }
}
