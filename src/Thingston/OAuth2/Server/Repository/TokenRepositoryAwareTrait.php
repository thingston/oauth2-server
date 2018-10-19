<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/ Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Thingston\OAuth2\Server\Repository;

/**
 * Token repository aware trait.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
trait TokenRepositoryAwareTrait
{

    /**
     * @var TokenRepositoryInterface
     */
    private $tokenRepository;

    /**
     * Set token repository.
     *
     * @param TokenRepositoryInterface $repository
     * @return TokenRepositoryAwareInterface
     */
    public function setTokenRepository(TokenRepositoryInterface $repository): TokenRepositoryAwareInterface
    {
        $this->tokenRepository = $repository;

        return $this;
    }

    /**
     * Get token repository.
     *
     * @return TokenRepositoryInterface
     */
    public function getTokenRepository(): TokenRepositoryInterface
    {
        return $this->tokenRepository;
    }

}
