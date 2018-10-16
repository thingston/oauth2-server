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
 * Client entity.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class Client implements ClientInterface
{

    /**
     * Implements ClientInterface
     */
    use ClientTrait;

    /**
     * Create new instance.
     * 
     * @param string $id
     * @param string $secret
     */
    public function __construct(string $id, string $secret)
    {
        $this->id = $id;
        $this->secret = $secret;
    }

}
