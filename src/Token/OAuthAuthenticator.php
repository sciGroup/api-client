<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 18.09.17 18:53.
 */

namespace Sci\API\Client\Token;

use Sci\API\Client\Token\Storage\StorageInterface;

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
     * @var StorageInterface
     */
    private $storage;

    /**
     * @var string Used as a key to store token data
     */
    private $tokenKey;

    public function __construct(string $clientId, string $clientSecret, StorageInterface $storage, string $tokenKey)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->storage = $storage;
        $this->tokenKey = $tokenKey;
    }

    public function getToken(): string
    {
        if ($token = $this->storage->get($this->tokenKey)) {
            
        }
    }
}