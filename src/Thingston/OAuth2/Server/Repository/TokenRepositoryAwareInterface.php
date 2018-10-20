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
 * Token repository aware interface.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
interface TokenRepositoryAwareInterface
{

    /**
     * Set token repository.
     *
     * @param TokenRepositoryInterface $repository
     * @return TokenRepositoryAwareInterface
     */
    public function setTokenRepository(TokenRepositoryInterface $repository): TokenRepositoryAwareInterface;

    /**
     * Get token repository.
     *
     * @return TokenRepositoryInterface
     */
    public function getTokenRepository(): TokenRepositoryInterface;
}
