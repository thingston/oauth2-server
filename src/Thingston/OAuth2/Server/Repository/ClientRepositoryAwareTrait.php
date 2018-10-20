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

/**
 * Client repository aware trait.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
trait ClientRepositoryAwareTrait
{

    /**
     * @var ClientRepositoryInterface
     */
    private $clientRepository;

    /**
     * Set client repository.
     *
     * @param ClientRepositoryInterface $repository
     * @return ClientRepositoryAwareInterface
     */
    public function setClientRepository(ClientRepositoryInterface $repository): ClientRepositoryAwareInterface
    {
        $this->clientRepository = $repository;

        return $this;
    }

    /**
     * Get client repository.
     *
     * @return ClientRepositoryInterface
     */
    public function getClientRepository(): ClientRepositoryInterface
    {
        return $this->clientRepository;
    }
}
