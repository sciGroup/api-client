# The client library to query API

## Usage

* Get a client_id/client_secret pair with `ROLE_OAUTH_SERVER` role.
* Initialize an object of the `Client` class for making requests.

## `ROLE_OAUTH_SERVER` gives access to the following methods

* `Client::eventSearch`

## `ROLE_OAUTH_TRUSTED_SERVER` gives access to the following methods

* `Client::requestPasswordResetting`
* `Client::resetPassword`

## Example

```
// Implement HTTPTransportInterface interface
$authenticator = new OAuthAuthenticator('https://base/path/to/auth/endpoint', 'client_id', 'client_secret', new FileTokenStorage(), $HTTPTransport);
$client = new Client('https://base/path', $authenticator, $HTTPTransport);
```  
