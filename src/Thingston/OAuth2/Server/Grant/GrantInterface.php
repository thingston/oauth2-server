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

/**
 * Grant interface.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
interface GrantInterface
{

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
    public function getResponseType(): ?string;

    /**
     * Get unique grant type value used on POST requests to token
     * endpoint (null if not supported).
     *
     * @return string
     */
    public function getGrantType(): ?string;

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
