<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 18.09.17 18:45.
 */

namespace Sci\API\Client;

use Sci\API\Client\Token\OAuthToken;

class Client
{
    /**
     * @var OAuthToken
     */
    private $token;

    public function __construct(OAuthToken $token)
    {
        $this->token = $token;
    }

    public function eventSearch(string $query): array
    {

    }
}