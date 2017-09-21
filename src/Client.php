<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 18.09.17 18:45.
 */

namespace Sci\API\Client;

use Sci\API\Client\HTTPTransport\HTTPTransportInterface;
use Sci\API\Client\Model\Request\Event\EventSearchRequest;
use Sci\API\Client\Token\OAuthAuthenticator;

class Client
{
    /**
     * @var string
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

    public function eventSearch(EventSearchRequest $request): array
    {
        $rawResponse = $this->transport->get($request->getQuery($this->basePath), ['HTTP_Authorization' => 'Bearer '.$this->authenticator->getToken()]);

    }
}