<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/crawler Public Git repository
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
}
