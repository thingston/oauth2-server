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
use Thingston\OAuth2\Server\Error\UnsupportedResponseTypeError;

/**
 * Unsupported response type error test case.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class UnsupportedResponseTypeErrorTest extends TestCase
{

    public function testErrorState()
    {
        $description = 'My error description.';
        $error = new UnsupportedResponseTypeError($description);

        $this->assertEquals($description, $error->getDescription());
        $this->assertEquals(UnsupportedResponseTypeError::UNSUPPORTED_RESPONSE_TYPE_CODE, $error->getCode());
        $this->assertEquals(UnsupportedResponseTypeError::UNSUPPORTED_RESPONSE_TYPE_STATUS, $error->getStatus());
        $this->assertEquals(UnsupportedResponseTypeError::DEFAULT_URI, $error->getUri());

        $this->assertArrayHasKey('description', $error->jsonSerialize());
        $this->assertEquals($error->getDescription(), $error->jsonSerialize()['description']);
        $this->assertArrayHasKey('code', $error->jsonSerialize());
        $this->assertEquals($error->getCode(), $error->jsonSerialize()['code']);
        $this->assertArrayHasKey('status', $error->jsonSerialize());
        $this->assertEquals($error->getStatus(), $error->jsonSerialize()['status']);
        $this->assertArrayHasKey('uri', $error->jsonSerialize());
        $this->assertEquals($error->getUri(), $error->jsonSerialize()['uri']);
    }
}
