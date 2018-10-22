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

/**
 * Scope entity.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class Scope implements ScopeInterface
{

    use ScopeTrait;

    /**
     * Create new instance.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->setName($name);
    }
}
