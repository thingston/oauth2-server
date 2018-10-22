<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/oauth2-server Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Thingston\OAuth2\Server\Grant;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Thingston\OAuth2\Server\Entity\AccessToken;
use Thingston\OAuth2\Server\Entity\RefreshToken;
use Thingston\OAuth2\Server\Error\AccessDeniedError;
use Thingston\OAuth2\Server\Error\InvalidRequestError;
use Thingston\OAuth2\Server\Error\UnauthorizedClientError;
use Thingston\OAuth2\Server\Http\ClientCredentialsRequest;
use Thingston\OAuth2\Server\Http\ErrorResponse;
use Thingston\OAuth2\Server\Http\TokenResponse;
use Thingston\OAuth2\Server\Repository\ClientRepositoryInterface;
use Thingston\OAuth2\Server\Repository\TokenRepositoryInterface;
use Thingston\OAuth2\Server\Repository\UserRepositoryInterface;

/**
 * Resource owner credentials grant.
 *
 * @see https://tools.ietf.org/html/rfc6749#section-4.3
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class ResourceOwnerCredentialsGrant extends AbstractGrant
{

    /**
     * Grant type value
     */
    const GRANT_TYPE = 'password';

    /**
     * Create new instance.
     *
     * @param ClientRepositoryInterface $clientRepository
     * @param UserRepositoryInterface $userRepository
     * @param TokentRepositoryInterface $tokenRepository
     * @param int $ttl
     */
    public function __construct(ClientRepositoryInterface $clientRepository, UserRepositoryInterface $userRepository, TokenRepositoryInterface $tokenRepository, int $ttl = AccessToken::TTL)
    {
        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
        $this->tokenRepository = $tokenRepository;
        $this->ttl = $ttl;
        $this->grantType = self::GRANT_TYPE;
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

        if (false === $client->isConfidential()) {
            return new ErrorResponse(new UnauthorizedClientError('Invalid client type.'));
        }

        if (false === $client->verify($secret)) {
            return new ErrorResponse(new AccessDeniedError('Invalid client credentials.'));
        }

        $params = $request->getParsedBody();

        if (false === isset($params['username'])) {
            return new ErrorResponse(new InvalidRequestError('Missing username.'));
        }

        if (false === isset($params['password'])) {
            return new ErrorResponse(new InvalidRequestError('Missing password.'));
        }

        /* @var $user \Thingston\OAuth2\Server\Entity\UserInterface */
        if (null === $user = $this->getUserRepository()->find($params['username'])) {
            return new ErrorResponse(new AccessDeniedError('Invalid user credentials.'));
        }

        if (false === $user->verify($params['password'])) {
            return new ErrorResponse(new AccessDeniedError('Invalid user credentials.'));
        }

        $refreshToken = new RefreshToken($client, $user);
        $this->tokenRepository->save($refreshToken);

        $accessToken = new AccessToken($client, $user, $refreshToken, $this->ttl);
        $this->tokenRepository->save($accessToken);

        return new TokenResponse($accessToken);
    }
}
