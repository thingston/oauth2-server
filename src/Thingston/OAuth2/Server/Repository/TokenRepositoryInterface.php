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

use Thingston\OAuth2\Server\Entity\TokenInterface;

/**
 * Token repository interface.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
interface TokenRepositoryInterface
{

    /**
     * Check either repository contains a given token.
     *
     * @param TokenInterface $token
     * @return bool
     */
    public function contains(TokenInterface $token): bool;

    /**
     * Save a given token into repository.
     *
     * @param TokenInterface $token
     * @return TokenRepositoryInterface
     */
    public function save(TokenInterface $token): TokenRepositoryInterface;

    /**
     * Remove a given token from repository.
     *
     * @param TokenInterface $token
     * @return TokenRepositoryInterface
     */
    public function remove(TokenInterface $token): TokenRepositoryInterface;

    /**
     * Find a single token by identifier.
     *
     * @param string $id
     * @return TokenInterface|null
     */
    public function find(string $id): ?TokenInterface;
}
