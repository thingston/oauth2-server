<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/ Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Thingston\OAuth2\Server\Grant;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Thingston\OAuth2\Server\Error\AccessDeniedError;
use Thingston\OAuth2\Server\Error\InvalidRequestError;
use Thingston\OAuth2\Server\Error\UnauthorizedClientError;
use Thingston\OAuth2\Server\Http\ClientCredentialsRequest;
use Thingston\OAuth2\Server\Http\ErrorResponse;
use Thingston\OAuth2\Server\Http\TokenResponse;

/**
 * Client credentials grant.
 *
 * @see https://tools.ietf.org/html/rfc6749#section-4.4
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class ClientCredentialsGrant extends AbstractGrant
{

    /**
     * Grant type value
     */
    const GRANT_TYPE = 'client_credentials';

    /**
     * Get unique grant type value used on POST requests to token
     * endpoint (null if not supported).
     *
     * @return string
     */
    public function getGrantType(): ?string
    {
        return self::GRANT_TYPE;
    }

    /**
     * Create a token.
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function token(ServerRequestInterface $request): ResponseInterface
    {
        $credentials = new ClientCredentialsRequest($request);

        if (null === $id = $credentials->getId()) {
            return new ErrorResponse(new InvalidRequestError('Missing client credentials.'));
        }

        if (null === $secret = $credentials->getSecret()) {
            return new ErrorResponse(new InvalidRequestError('Missing client credentials.'));
        }

        /* @var $client \Thingston\OAuth2\Server\Entity\ClientInterface */
        if (null === $client = $this->getClientRepository()->find($id)) {
            return new ErrorResponse(new AccessDeniedError('Invalid client credentials.'));
        }

        if (false === $client->verify($secret)) {
            return new ErrorResponse(new AccessDeniedError('Invalid client credentials.'));
        }

        $token = $this->getTokenRepository()->create($client);

        return new TokenResponse($token);
    }

}
