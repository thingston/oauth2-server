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
 * Access token entity interface.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
interface AccessTokenInterface extends TokenInterface
{

    /**
     * Get refresh token.
     *
     * @return RefreshTokenInterface|null
     */
    public function getRefreshToken(): ?RefreshTokenInterface;
}
