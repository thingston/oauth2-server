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

use Thingston\OAuth2\Server\Entity\ClientInterface;

/**
 * Client repository interface.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
interface ClientRepositoryInterface
{

    /**
     * Check either repository contains a given client.
     *
     * @param ClientInterface $client
     * @return bool
     */
    public function contains(ClientInterface $client): bool;

    /**
     * Save a given client into repository.
     *
     * @param ClientInterface $client
     * @return ClientRepositoryInterface
     */
    public function save(ClientInterface $client): ClientRepositoryInterface;

    /**
     * Remove a given client from repository.
     *
     * @param ClientInterface $client
     * @return ClientRepositoryInterface
     */
    public function remove(ClientInterface $client): ClientRepositoryInterface;

    /**
     * Find a single client by identifier.
     *
     * @param string $id
     * @return ClientInterface|null
     */
    public function find(string $id): ?ClientInterface;
}
