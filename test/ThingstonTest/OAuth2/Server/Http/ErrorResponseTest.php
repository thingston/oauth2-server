<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/oauth2-server Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace ThingstonTest\OAuth2\Server\Exception;

use PHPUnit\Framework\TestCase;
use Thingston\OAuth2\Server\Error\Error;
use Thingston\OAuth2\Server\Http\ErrorResponse;

/**
 * Error response test case.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class ErrorResponseTest extends TestCase
{

    public function testErrorResponse()
    {
        $error = new Error('access_denied', 401);
        $response = new ErrorResponse($error);

        $this->assertEquals(401, $response->getStatusCode());
    }
}
