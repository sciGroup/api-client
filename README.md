# The client library to query API

## Usage

* Get a client_id/client_secret pair with `ROLE_OAUTH_SERVER` role.
* Initialize an object of the `Client` class for making requests.

## Example

```
// Implement HTTPTransportInterface interface
$authenticator = new OAuthAuthenticator('client_id', 'client_secret', new FileTokenStorage(), $HTTPTransport);
$client = new Client('https://base/path', $authenticator, $HTTPTransport);
```  
