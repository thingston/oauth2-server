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
 * User entity interface.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
interface UserInterface
{

    /**
     * Set unique username.
     *
     * @param string $username
     * @return UserInterface
     */
    public function setUsername(string $username): UserInterface;

    /**
     * Get unique username.
     *
     * @return string
     */
    public function getUsername(): string;

    /**
     * Set user password.
     *
     * @param string $password
     * @return UserInterface
     */
    public function setPassword(string $password): UserInterface;

    /**
     * Get user password key.
     *
     * @return string
     */
    public function getPassword(): string;

    /**
     * Encrypt password.
     *
     * @param string $password
     * @return string
     */
    public static function encrypt(string $password): string;

    /**
     * Verify password.
     *
     * @param string $password
     * @return bool
     */
    public function verify(string $password): bool;
}
