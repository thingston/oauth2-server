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

use Thingston\OAuth2\Server\Entity\ScopeInterface;

/**
 * Scope repository interface.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
interface ScopeRepositoryInterface
{

    /**
     * Check either repository contains a given scope.
     *
     * @param ScopeInterface $scope
     * @return bool
     */
    public function contains(ScopeInterface $scope): bool;

    /**
     * Save a given scope into repository.
     *
     * @param ScopeInterface $scope
     * @return ScopeRepositoryInterface
     */
    public function save(ScopeInterface $scope): ScopeRepositoryInterface;

    /**
     * Remove a given scope from repository.
     *
     * @param ScopeInterface $scope
     * @return ScopeRepositoryInterface
     */
    public function remove(ScopeInterface $scope): ScopeRepositoryInterface;

    /**
     * Find a single scope by name.
     *
     * @param string $name
     * @return ScopeInterface|null
     */
    public function find(string $name): ?ScopeInterface;
}
