<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 19.09.17 12:21.
 */

namespace Sci\API\Client\Token;


use Psr\Http\Message\ResponseInterface;

class OAuthTokenFactory
{
    public function getToken(ResponseInterface $response): OAuthToken
    {
        $responseBody = (string) $response->getBody();
        $tokenData = json_decode($responseBody, true);

        return new OAuthToken(
            $tokenData['access_token'],
            $tokenData['expires_in'],
            $tokenData['token_type'],
            $tokenData['scope'],
            $tokenData['refresh_token'] ?? null
        );
    }
}