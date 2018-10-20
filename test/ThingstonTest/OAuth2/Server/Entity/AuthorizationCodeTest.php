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
use Thingston\OAuth2\Server\Entity\AuthorizationCode;
use Thingston\OAuth2\Server\Entity\ClientInterface;
use Thingston\OAuth2\Server\Entity\UserInterface;

/**
 * Authorization code test case.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class AuthorizationCodeTest extends TestCase
{

    public function testAuthorizationCodeState()
    {
        $client = $this->getMockBuilder(ClientInterface::class)->getMock();
        $user = $this->getMockBuilder(UserInterface::class)->getMock();
        $ttl = AuthorizationCode::TTL;
        $type = AuthorizationCode::TYPE;

        $code = new AuthorizationCode($client, $user, $ttl, $type);

        $this->assertSame($client, $code->getClient());
        $this->assertSame($user, $code->getUser());
        $this->assertEquals($type, $code->getType());
        $this->assertInstanceOf(\DateTimeInterface::class, $code->getCreatedAt());
        $this->assertInstanceOf(\DateTimeInterface::class, $code->getExpiresAt());
        $this->assertGreaterThan(0, $code->getExpiresIn());
        $this->assertFalse($code->isExpired());
        $this->assertArrayHasKey('code', $code->jsonSerialize());
        $this->assertEquals($code->getToken(), $code->jsonSerialize()['code']);
    }
}
