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
use Thingston\OAuth2\Server\Error\MethodNotAllowedError;
use Thingston\OAuth2\Server\Http\ErrorResponse;
use Thingston\OAuth2\Server\Repository\ClientRepositoryInterface;
use Thingston\OAuth2\Server\Repository\TokenRepositoryInterface;
use Thingston\OAuth2\Server\Repository\UserRepositoryInterface;

/**
 * Abstract grant.
 *
 * @see https://tools.ietf.org/html/rfc6749#section-4.4
 * @author Pedro Ferreira <pedro@thingston.com>
 */
abstract class AbstractGrant implements GrantInterface
{

    /**
     * @var ClientRepository
     */
    protected $clientRepository;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var TokenRepository
     */
    protected $tokenRepository;

    /**
     * @var int
     */
    protected $ttl;

    /**
     * @var string
     */
    protected $responseType;

    /**
     * @var string
     */
    protected $grantType;

    /**
     * Get client repository.
     *
     * @return ClientRepositoryInterface
     */
    public function getClientRepository(): ClientRepositoryInterface
    {
        return $this->clientRepository;
    }

    /**
     * Get user repository.
     *
     * @return UserRepositoryInterface
     */
    public function getUserRepository(): UserRepositoryInterface
    {
        return $this->userRepository;
    }

    /**
     * Get token repository.
     *
     * @return TokenRepositoryInterface
     */
    public function getTokenRepository(): TokenRepositoryInterface
    {
        return $this->tokenRepository;
    }

    /**
     * Get TTL.
     *
     * @return int
     */
    public function getTtl(): int
    {
        return $this->ttl;
    }

    /**
     * Get unique identifier key.
     *
     * @return string
     */
    public function getKey(): string
    {
        return md5(get_class($this));
    }

    /**
     * Get unique response type value used on GET requests to authorize
     * endpoint ( (null if not supported)).
     *
     * @return string
     */
    public function getResponseType(): string
    {
        return $this->responseType;
    }

    /**
     * Get unique grant type value used on POST requests to token
     * endpoint (null if not supported).
     *
     * @return string
     */
    public function getGrantType(): string
    {
        return $this->grantType;
    }

    /**
     * Authorize a request.
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function authorize(ServerRequestInterface $request): ResponseInterface
    {
        $error = new MethodNotAllowedError('Authorization not implemented.');

        return new ErrorResponse($error);
    }

    /**
     * Create a token.
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    abstract public function token(ServerRequestInterface $request): ResponseInterface;
}
