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
 * Client entity trait.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
trait ClientTrait
{

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $secret;

    /**
     * Set client unique identifier.
     *
     * @param string $id
     * @return ClientInterface
     */
    public function setId(string $id): ClientInterface
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get client unique identifier.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set client secret key.
     *
     * @param string $secret
     * @return ClientInterface
     */
    public function setSecret(string $secret): ClientInterface
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * Get client secret key.
     *
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

}
