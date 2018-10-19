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

/**
 * Authorization code entity interface.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
interface AuthorizationCodeInterface extends TokenInterface
{

    /**
     * Get code (same as token).
     *
     * @return string
     */
    public function getCode(): string;

    /**
     * Get state.
     *
     * @return string|null
     */
    public function getState(): ?string;
}
