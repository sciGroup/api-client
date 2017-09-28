<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 18.09.17 18:45.
 */

namespace Sci\API\Client;

use Sci\API\Client\HTTPTransport\HTTPTransportInterface;
use Sci\API\Client\Model\Request\Event\EventSearchRequestParameters;
use Sci\API\Client\Model\ResponseTransformer\EventSearchResponseTransformer;
use Sci\API\Client\Model\Wrapper\EventSearchResponseWrapper;
use Sci\API\Client\Token\OAuthAuthenticator;

class Client
{
    /**
     * @var string Without trailing slash
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

    /**
     * Requires ROLE_OAUTH_SERVER
     */
    public function eventSearch(EventSearchRequestParameters $requestParameters): EventSearchResponseWrapper
    {
        $response = $this->transport->get($requestParameters->getQueryString($this->basePath).'&access_token='.$this->authenticator->getToken());

        return (new EventSearchResponseTransformer())->transform($response);
    }

    /**
     * Requires ROLE_OAUTH_TRUSTED_SERVER
     *
     * @param string $username
     * @return string confirmation token
     * @throws \Exception
     */
    public function requestPasswordResetting(string $username): string
    {
        $requestResettingURI = sprintf('%s/open-api/v1/rus/user/password/request-resetting?access_token=%s', $this->basePath, $this->authenticator->getToken());
        $response = $this->transport->post($requestResettingURI, ['username' => $username]);
        $responseData = json_decode($response->getBody(), true);
        if (!isset($responseData['confirmation_token'])) {
            throw new \Exception('confirmation_token was not returned!');
        }

        return $responseData['confirmation_token'];
    }

    /**
     * Requires ROLE_OAUTH_TRUSTED_SERVER
     * @param string $username
     * @param string $token
     * @param string $newPassword
     * @throws \Exception
     */
    public function resetPassword(string $username, string $token, string $newPassword)
    {
        $resetURI = sprintf('%s/open-api/v1/rus/user/confirmation-token/%s/password/reset?access_token=%s', $this->basePath, $token, $this->authenticator->getToken());
        $response = $this->transport->post($resetURI, [
            'username' => $username,
            'password' => $newPassword,
        ]);
        if (204 !== $response->getStatusCode()) {
            throw new \Exception(sprintf('Can\'t set new password "%s" for user "%s" with token "%s"', $newPassword, $username, $token));
        }
    }
}
