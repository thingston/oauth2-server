<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/oauth2-server Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Thingston\OAuth2\Server;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Thingston\OAuth2\Server\Exception\InvalidArgumentException;
use Thingston\OAuth2\Server\Error\InvalidRequestError;
use Thingston\OAuth2\Server\Error\MethodNotAllowedError;
use Thingston\OAuth2\Server\Grant\GrantInterface;
use Thingston\OAuth2\Server\Http\ErrorResponse;

/**
 * OAuth2 Authorization Server.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class AuthorizationServer
{

    /**
     * @var array
     */
    private $grants;

    /**
     * Create new instance.
     *
     * @param array $grants
     */
    public function __construct(array $grants = [])
    {
        $this->grants = [];

        foreach ($grants as $grant) {
            $this->addGrant($grant);
        }
    }

    /**
     * Add grant support.
     *
     * @param GrantInterface $grant
     * @return Server
     * @throws InvalidArgumentException
     */
    public function addGrant(GrantInterface $grant): AuthorizationServer
    {
        $this->grants[$grant->getKey()] = $grant;

        return $this;
    }

    /**
     * Remove grant support.
     *
     * @param GrantInterface $grant
     * @return Server
     */
    public function removeGrant(GrantInterface $grant): AuthorizationServer
    {
        unset($this->grants[$grant->getKey()]);

        return $this;
    }

    /**
     * Get array of all grants supported.
     *
     * @return array
     */
    public function getGrants(): array
    {
        return array_values($this->grants);
    }

    /**
     * Handle an HTTP request and return a response.
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (null === $grant = $this->resolve($request)) {
            $error = new InvalidRequestError('Request options don\'t match any supported grant.');
            return new ErrorResponse($error);
        }

        $method = 'GET'=== $request->getMethod() ? 'authorize' : 'token';

        return $grant->$method($request);
    }

    /**
     * Resolve an HTTP request against supported grants.
     *
     * @param ServerRequestInterface $request
     * @return GrantInterface|null
     */
    public function resolve(ServerRequestInterface $request): ?GrantInterface
    {
        $method = $request->getMethod();

        if ('GET' === $method) {
            $params = $request->getQueryParams();

            if (null === $type = $params['response_type'] ?? null) {
                return null;
            }

            foreach ($this->grants as $grant) {
                if ($type === $grant->getResponseType()) {
                    return $grant;
                }
            }
        }

        if ('POST' === $method) {
            $params = $request->getParsedBody();

            if (null === $type = $params['grant_type'] ?? null) {
                return null;
            }

            foreach ($this->grants as $grant) {
                if ($type === $grant->getGrantType()) {
                    return $grant;
                }
            }
        }

        return null;
    }
}
