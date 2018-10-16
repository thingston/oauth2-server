<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/crawler Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Thingston\OAuth2Server\Entity;

/**
 * Client entity interface.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
interface ClientInterface
{

    /**
     * Set client unique identifier.
     *
     * @param string $id
     * @return ClientInterface
     */
    public function setId(string $id): ClientInterface;

    /**
     * Get client unique identifier.
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Set client secret key.
     *
     * @param string $secret
     * @return ClientInterface
     */
    public function setSecret(string $secret): ClientInterface;

    /**
     * Get client secret key.
     *
     * @return string
     */
    public function getSecret(): string;
}
