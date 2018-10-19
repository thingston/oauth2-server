<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/ Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Thingston\OAuth2\Server\Http;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Client credentials request.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class ClientCredentialsRequest
{

    /**
     * @var ServerRequestInterface
     */
    private $request;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $secret;

    /**
     * Create new instance.
     *
     * @param ServerRequestInterface $request
     */
    public function __construct(ServerRequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * Check either the request brings client credentials.
     *
     * @return bool
     */
    public function hasClient(): bool
    {
        if (false === $this->id) {
            return false;
        }

        return (bool) $this->getId();
    }

    /**
     * Get client id.
     *
     * @return string|null
     */
    public function getId(): ?string
    {
        if (false === $this->id) {
            return null;
        }

        if (null === $this->id) {
            $this->inspect();
        }

        return $this->id;
    }

    /**
     * Get client secret.
     *
     * @return ?string
     */
    public function getSecret(): ?string
    {
        if (false === $this->secret) {
            return null;
        }

        if (null === $this->secret) {
            $this->inspect();
        }

        return $this->secret;
    }

    /**
     * Inspect full request to extract client credentials.
     *
     * @return ClientCredentialsRequest
     */
    public function inspect(): ClientCredentialsRequest
    {
        $this->id = false;
        $this->secret = false;

        if (true === $this->request->hasHeader('Authorization')) {
            return $this->inspectAuthorizationHeader($this->request->getHeader('Authorization'));
        }

        if ('' === $userInfo = $this->request->getUri()->getUserInfo()) {
            return $this->inspectUserInfo($userInfo);
        }

        if (false === empty($params = $this->request->getParsedBody())) {
            return $this->inspectBodyParams($params);
        }

        return $this;
    }

    /**
     * Inspect authorization header to extract client credentials.
     *
     * @return ClientCredentialsRequest
     */
    public function inspectAuthorizationHeader(array $header): ClientCredentialsRequest
    {
        $this->id = false;
        $this->secret = false;

        if (true === empty($header)) {
            return $this;
        }

        if ('basic' !== strtolower(substr($header[0], 0, 5))) {
            return $this;
        }

        if ('' === $hash = trim(substr($header[0], 5))) {
            return $this;
        }

        $parts = explode(':', $hash, 2);

        $this->id = urldecode($parts[0]);
        $this->secret = $parts[1] ?? urldecode($parts[1]);

        return $this;
    }

    /**
     * Inspect user-info header to extract client credentials.
     *
     * @return ClientCredentialsRequest
     */
    public function inspectUserInfo(string $userInfo): ClientCredentialsRequest
    {
        $this->id = false;
        $this->secret = false;

        $parts = explode(':', $userInfo, 2);

        $this->id = urldecode($parts[0]);
        $this->secret = $parts[1] ?? urldecode($parts[1]);

        return $this;
    }

    /**
     * Inspect parsed parameters from body header to extract client credentials.
     *
     * @return ClientCredentialsRequest
     */
    public function inspectBodyParams(array $params): ClientCredentialsRequest
    {
        $this->id = false;
        $this->secret = false;

        $this->id = $params['client_id'] ?? urldecode($params['client_id']);
        $this->secret = $params['client_secret'] ?? urldecode($params['client_secret']);

        return $this;
    }
}
