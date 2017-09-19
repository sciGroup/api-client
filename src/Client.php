<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 18.09.17 18:45.
 */

namespace Sci\API\Client;

use Sci\API\Client\Token\OAuthAuthenticator;

class Client
{
    /**
     * @var OAuthAuthenticator
     */
    private $authenticator;

    public function __construct(OAuthAuthenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    public function eventSearch(string $query): array
    {

    }
}