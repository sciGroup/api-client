<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 19.09.17 10:23.
 */

namespace Sci\API\Client\Token;


final class OAuthToken
{
    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var int
     */
    private $expiresIn;

    /**
     * @var string
     */
    private $tokenType;

    /**
     * @var string|null
     */
    private $scope;

    /**
     * @var string
     */
    private $refreshToken;

    /**
     * @var int Unix timestamp
     */
    private $issuedAt;

    /**
     * OAuthToken constructor.
     * @param string $accessToken
     * @param string $refreshToken
     * @param int $expiresIn
     * @param string $tokenType
     * @param null|string $scope
     */
    public function __construct($accessToken, $refreshToken, $expiresIn, $tokenType, $scope = null)
    {
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->expiresIn = $expiresIn;
        $this->tokenType = $tokenType;
        $this->scope = $scope;
        $this->issuedAt = time();
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    /**
     * @return string
     */
    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    /**
     * @return null|string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->issuedAt + $this->expiresIn > time();
    }
}