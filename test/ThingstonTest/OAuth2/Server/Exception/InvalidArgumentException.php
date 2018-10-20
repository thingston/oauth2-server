<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/oauth2-server Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace ThingstonTest\OAuth2\Server\Http;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Thingston\OAuth2\Server\Exception\InvalidArgumentException;
use Thingston\OAuth2\Server\Exception\ServerExceptionInterface;

/**
 * Invalid argument exception test case.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class InvalidArgumentExceptionTest extends TestCase
{

    public function testExceptionType()
    {
        $exception = new InvalidArgumentException();
        $this->assertInstanceOf(ServerExceptionInterface::class, $exception);
        $this->assertInstanceOf(InvalidArgumentException::class, $exception);
    }
}
