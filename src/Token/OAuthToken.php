<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 18.09.17 18:53.
 */

namespace Sci\API\Client\Token;

use Sci\API\Client\Token\Storage\StorageInterface;

class OAuthToken
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

    public function __construct(string $clientId, string $clientSecret, StorageInterface $storage)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->storage = $storage;
    }

    public function getToken(): string
    {
        return '';
    }
}