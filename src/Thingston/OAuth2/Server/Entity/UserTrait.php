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
 * User trait.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
trait UserTrait
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * Set username.
     *
     * @param string $username
     * @return UserInterface
     */
    public function setUsername(string $username): UserInterface
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Set password.
     *
     * @param string $password
     * @return UserInterface
     */
    public function setPassword(string $password): UserInterface
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get client password key.
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Encrypt password.
     *
     * @param string $password
     * @return string
     */
    public static function encrypt(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Verify password.
     *
     * @param string $password
     * @return bool
     */
    public function verify(string $password): bool
    {
        return password_verify($password, $this->password);
    }
}
