<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/ Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Thingston\OAuth2\Server\Entity;

use DateTimeInterface;
use JsonSerializable;

/**
 * Token entity interface.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
interface TokenInterface extends JsonSerializable
{

    /**
     * Get client.
     *
     * @return ClientInterface
     */
    public function getClient(): ClientInterface;

    /**
     * Get created at datetime.
     *
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface;

    /**
     * Get created at datetime.
     *
     * @return DateTimeInterface
     */
    public function getExpiresAt(): DateTimeInterface;

    /**
     * Get expires in seconds.
     *
     * @return int
     */
    public function getExpiresIn(): int;

    /**
     * Check either token is already expired.
     *
     * @return bool
     */
    public function isExpired(): bool;

    /**
     * Get token.
     *
     * @return string
     */
    public function getToken(): string;

    /**
     * Get token type.
     *
     * @return string
     */
    public function getType(): string;
}
