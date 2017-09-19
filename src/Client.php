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
     * @var OAuthAuthenticator
     */
    private $authenticator;

    /**
     * @var HTTPTransportInterface
     */
    private $transport;

    public function __construct(OAuthAuthenticator $authenticator, HTTPTransportInterface $transport)
    {
        $this->authenticator = $authenticator;
        $this->transport = $transport;
    }

    public function eventSearch(EventSearchRequest $request): array
    {
        $response = $this->transport->get($request->getQuery(), ['HTTP_Authorization' => 'Bearer '.$this->authenticator->getToken()]);
    }
}