<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/oauth2-server Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Thingston\OAuth2\Server\Repository;

use Thingston\OAuth2\Server\Entity\UserInterface;

/**
 * User repository interface.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
interface UserRepositoryInterface
{

    /**
     * Check either repository contains a given user.
     *
     * @param UserInterface $user
     * @return bool
     */
    public function contains(UserInterface $user): bool;

    /**
     * Save a given user into repository.
     *
     * @param UserInterface $user
     * @return UserRepositoryInterface
     */
    public function save(UserInterface $user): UserRepositoryInterface;

    /**
     * Remove a given user from repository.
     *
     * @param UserInterface $user
     * @return UserRepositoryInterface
     */
    public function remove(UserInterface $user): UserRepositoryInterface;

    /**
     * Find a single user by username.
     *
     * @param string $username
     * @return UserInterface|null
     */
    public function find(string $username): ?UserInterface;
}
