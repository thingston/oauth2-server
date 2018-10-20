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

use PHPUnit\Framework\TestCase;
use Thingston\OAuth2\Server\Entity\TokenInterface;
use Thingston\OAuth2\Server\Http\TokenResponse;

/**
 * Token response test case.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class TokenResponseTest extends TestCase
{

    public function testTokenResponse()
    {
        $token = $this->getMockBuilder(TokenInterface::class)->getMock();
        $token->expects($this->any())->method('jsonSerialize')->willReturn(['access_token' => uniqid()]);

        $response = new TokenResponse($token);

        $this->assertEquals(201, $response->getStatusCode());
    }
}
