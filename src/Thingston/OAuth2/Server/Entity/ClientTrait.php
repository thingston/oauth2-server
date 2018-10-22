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
 * Client trait.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
trait ClientTrait
{

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var bool
     */
    private $confidential;

    /**
     * @var bool
     */
    private $redirectUris;

    /**
     * Set id.
     *
     * @param string $id
     * @return ClientInterface
     */
    public function setId(string $id): ClientInterface
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set secret.
     *
     * @param string $secret
     * @return ClientInterface
     */
    public function setSecret(string $secret): ClientInterface
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * Get client secret key.
     *
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * Encrypt secret.
     *
     * @param string $secret
     * @return string
     */
    public static function encrypt(string $secret): string
    {
        return password_hash($secret, PASSWORD_BCRYPT);
    }

    /**
     * Verify secret.
     *
     * @param string $secret
     * @return bool
     */
    public function verify(string $secret): bool
    {
        return password_verify($secret, $this->secret);
    }

    /**
     * Set client public.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-2.1
     * @return ClientInterface
     */
    public function setPublic(): ClientInterface
    {
        $this->confidential = false;

        return $this;
    }

    /**
     * Check this is a public client.
     *
     * @return bool
     */
    public function isPublic(): bool
    {
        return false === $this->confidential;
    }

    /**
     * Set client confidential.
     *
     * @see https://tools.ietf.org/html/rfc6749#section-2.1
     * @return ClientInterface
     */
    public function setConfidential(): ClientInterface
    {
        $this->confidential = true;

        return $this;
    }

    /**
     * Check this is a confidential client.
     *
     * @return bool
     */
    public function isConfidential(): bool
    {
        return $this->confidential;
    }

    /**
     * Check either redirect URI is registered with the client.
     *
     * @param string $redirectUri
     * @return bool
     */
    public function hasRedirectUri(string $redirectUri): bool
    {
        return in_array($redirectUri, $this->redirectUris);
    }

    /**
     * Register a new redirect URI with the client.
     *
     * @param string $redirectUri
     * @return ClientInterface
     */
    public function addRedirectUri(string $redirectUri): ClientInterface
    {
        if (false === $this->hasRedirectUri($redirectUri)) {
            $this->redirectUris[] = $redirectUri;
        }

        return $this;
    }

    /**
     * Remove a registered redirect URI.
     *
     * @param string $redirectUri
     * @return ClientInterface
     */
    public function removeRedirectUri(string $redirectUri): ClientInterface
    {
        foreach ($this->redirectUris as $key => $uri) {
            if ($redirectUri === $uri) {
                unset($this->redirectUris[$key]);
                break;
            }
        }

        return $this;
    }

    /**
     * Get all registered redirect URIs.
     *
     * @return array
     */
    public function getRedirectUris(): array
    {
        return $this->redirectUris;
    }

}
