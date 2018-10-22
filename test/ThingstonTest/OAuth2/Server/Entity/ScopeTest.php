<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/oauth2-server Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace ThingstonTest\OAuth2\Server\Entity;

use PHPUnit\Framework\TestCase;
use Thingston\OAuth2\Server\Entity\Scope;
use Thingston\OAuth2\Server\Exception\InvalidArgumentException;

/**
 * Scope test case.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class ScopeTest extends TestCase
{

    public function testScopeState()
    {
        $name = uniqid();

        $scope = new Scope($name);

        $this->assertEquals($name, $scope->getName());
    }

    public function testInvalidScopeName()
    {
        $scope = new Scope('name_without_spaces');
        $this->expectException(InvalidArgumentException::class);
        $scope->setName('name with spaces');
    }
}
