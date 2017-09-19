<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 18.09.17 18:53.
 */

namespace Sci\API\Client\Token;

use Sci\API\Client\HTTPTransport\HTTPTransportInterface;
use Sci\API\Client\Token\Storage\TokenStorageInterface;

class OAuthAuthenticator
{
    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var HTTPTransportInterface
     */
    private $transport;

    public function __construct(string $clientId, string $clientSecret, TokenStorageInterface $tokenStorage, HTTPTransportInterface $transport)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->tokenStorage = $tokenStorage;
        $this->transport = $transport;
    }

    public function getToken(): OAuthToken
    {
        /** @var OAuthToken $token */
        if ($token = $this->tokenStorage->get()) {
            if (!$token->isValid()) {
                if ($refreshToken = $token->getRefreshToken()) {
                    $token = $this->refreshToken($refreshToken);
                    $this->tokenStorage->set($token);

                    return $token;
                }
            } else {
                return $token;
            }
        }

        $token = $this->authenticate();
        $this->tokenStorage->set($token);

        return $token;
    }

    private function authenticate(): OAuthToken
    {
        $URI = sprintf('https://api.lomonosov-msu.ru/oauth/v2/token?client_id=%s&client_secret=%s&grant_type=client_credentials', $this->clientId, $this->clientSecret);

        return (new OAuthTokenFactory())->getToken($this->transport->get($URI));
    }

    private function refreshToken(string $refreshToken): OAuthToken
    {
        $URI = sprintf('https://api.lomonosov-msu.ru/oauth/v2/token?client_id=%s&client_secret=%s&refresh_token=%s&grant_type=refresh_token', $this->clientId, $this->clientSecret, $refreshToken);

        return (new OAuthTokenFactory())->getToken($this->transport->get($URI));
    }
}