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
use Thingston\OAuth2\Server\Repository\ClientRepositoryInterface;
use Thingston\OAuth2\Server\Repository\TokenRepositoryInterface;
use Thingston\OAuth2\Server\Repository\UserRepositoryInterface;

/**
 * Grant interface.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
interface GrantInterface
{

    /**
     * Get client repository.
     *
     * @return ClientRepositoryInterface
     */
    public function getClientRepository(): ClientRepositoryInterface;

    /**
     * Get user repository.
     *
     * @return UserRepositoryInterface
     */
    public function getUserRepository(): UserRepositoryInterface;

    /**
     * Get token repository.
     *
     * @return TokenRepositoryInterface
     */
    public function getTokenRepository(): TokenRepositoryInterface;

    /**
     * Get TTL.
     *
     * @return int
     */
    public function getTtl(): int;
    /**
     * Get unique identifier key.
     *
     * @return string
     */
    public function getKey(): string;

    /**
     * Get unique response type value used on GET requests to authorize
     * endpoint ( (null if not supported)).
     *
     * @return string
     */
    public function getResponseType(): string;

    /**
     * Get unique grant type value used on POST requests to token
     * endpoint (null if not supported).
     *
     * @return string
     */
    public function getGrantType(): string;

    /**
     * Authorize a request.
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function authorize(ServerRequestInterface $request): ResponseInterface;

    /**
     * Create a token.
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function token(ServerRequestInterface $request): ResponseInterface;
}
