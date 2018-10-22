<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/oauth2-server Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Thingston\OAuth2\Server\Entity;

use Thingston\OAuth2\Server\Exception\InvalidArgumentException;

/**
 * Scope entity interface.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
interface ScopeInterface
{

    /**
     * Set unique scope name. It MUST not contain any spaces.
     *
     * @param string $name
     * @return UserInterface
     * @throws InvalidArgumentException
     */
    public function setName(string $name): ScopeInterface;

    /**
     * Get unique scope name.
     *
     * @return string
     */
    public function getName(): string;
}
