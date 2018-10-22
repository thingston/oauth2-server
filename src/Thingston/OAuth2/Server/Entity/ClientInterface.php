<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/oauth2-server Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Thingston\OAuth2\Server\Entity;

/**
 * Client entity interface.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
interface ClientInterface
{

    /**
     * Set client unique identifier.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-2.2
     * @param string $id
     * @return ClientInterface
     */
    public function setId(string $id): ClientInterface;

    /**
     * Get client unique identifier.
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Set client secret key.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-2.3.1
     * @param string $secret
     * @return ClientInterface
     */
    public function setSecret(string $secret): ClientInterface;

    /**
     * Get client secret key.
     *
     * @return string
     */
    public function getSecret(): string;

    /**
     * Encrypt secret.
     *
     * @param string $secret
     * @return string
     */
    public static function encrypt(string $secret): string;

    /**
     * Verify secret.
     *
     * @param string $secret
     * @return bool
     */
    public function verify(string $secret): bool;

    /**
     * Set client public.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-2.1
     * @return ClientInterface
     */
    public function setPublic(): ClientInterface;

    /**
     * Check this is a public client.
     *
     * @return bool
     */
    public function isPublic(): bool;

    /**
     * Set client confidential.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-2.1
     * @return ClientInterface
     */
    public function setConfidential(): ClientInterface;

    /**
     * Check this is a confidential client.
     *
     * @return bool
     */
    public function isConfidential(): bool;

    /**
     * Check either redirect URI is registered with the client.
     *
     * @param string $redirectUri
     * @return bool
     */
    public function hasRedirectUri(string $redirectUri): bool;

    /**
     * Register a new redirect URI with the client.
     *
     * @param string $redirectUri
     * @return ClientInterface
     */
    public function addRedirectUri(string $redirectUri): ClientInterface;

    /**
     * Remove a registered redirect URI.
     *
     * @param string $redirectUri
     * @return ClientInterface
     */
    public function removeRedirectUri(string $redirectUri): ClientInterface;

    /**
     * Get all registered redirect URIs.
     *
     * @return array
     */
    public function getRedirectUris(): array;

    /**
     * Check either scope is registered with the client.
     *
     * @param ScopeInterface $scope
     * @return bool
     */
    public function hasScope(ScopeInterface $scope): bool;

    /**
     * Register a new scope with the client.
     *
     * @param ScopeInterface $scope
     * @return ClientInterface
     */
    public function addScope(ScopeInterface $scope): ClientInterface;

    /**
     * Remove a registered scope.
     *
     * @param ScopeInterface $scope
     * @return ClientInterface
     */
    public function removeScope(ScopeInterface $scope): ClientInterface;

    /**
     * Get all registered scopes.
     *
     * @return array
     */
    public function getScopes(): array;
}
