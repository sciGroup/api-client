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
     * @var string|null
     */
    private $refreshToken;

    /**
     * @var int Unix timestamp
     */
    private $issuedAt;

    /**
     * @param string $accessToken
     * @param int $expiresIn
     * @param string $tokenType
     * @param null|string $scope
     * @param string $refreshToken
     */
    public function __construct($accessToken, $expiresIn, $tokenType, $scope = null, $refreshToken = null)
    {
        $this->accessToken = $accessToken;
        $this->expiresIn = $expiresIn;
        $this->tokenType = $tokenType;
        $this->scope = $scope;
        $this->refreshToken = $refreshToken;
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
     * @return string|null
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->issuedAt + $this->expiresIn > time();
    }
}