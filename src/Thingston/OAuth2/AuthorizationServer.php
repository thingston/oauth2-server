<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/crawler Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Thingston\OAuth2;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Thingston\OAuth2\Server\Exception\InvalidArgumentException;
use Thingston\OAuth2\Server\Error\InvalidRequestError;
use Thingston\OAuth2\Server\Error\MethodNotAllowedError;
use Thingston\OAuth2\Server\Grant\GrantInterface;
use Thingston\OAuth2\Server\Http\ErrorResponse;

/**
 * OAuth2 Server.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class AuthorizationServer
{

    /**
     * @var array
     */
    private $grants;

    public function __construct(array $grants)
    {
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
    public function addGrant(GrantInterface $grant): Server
    {
        if (false === $grant instanceof GrantInterface) {
            throw new InvalidArgumentException(sprintf('Expected instance of "%s" on adding grant.', GrantInterface::class));
        }

        $this->grants[$grant->getKey()] = $grant;

        return $this;
    }

    /**
     * Remove grant support.
     *
     * @param GrantInterface $grant
     * @return Server
     */
    public function removeGrant(GrantInterface $grant): Server
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

        switch ($request->getMethod()) {
            case 'GET' :
                return $grant->authorize($request);
            case 'POST' :
                return $grant->token($request);
        }

        $error = new MethodNotAllowedError('Request options don\'t match any supported method.');
        $response = (new ErrorResponse($error))->withAddedHeader('Allow', 'GET, POST');

        return $response;
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

            if (null === $type = $params['response_type'] ?? null) {
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
