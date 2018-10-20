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
use Thingston\OAuth2\Server\Entity\RefreshToken;
use Thingston\OAuth2\Server\Entity\ClientInterface;
use Thingston\OAuth2\Server\Entity\UserInterface;

/**
 * Refresh token test case.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class RefreshTokenTest extends TestCase
{

    public function testRefreshTokenState()
    {
        $client = $this->getMockBuilder(ClientInterface::class)->getMock();
        $user = $this->getMockBuilder(UserInterface::class)->getMock();
        $ttl = RefreshToken::TTL;
        $type = RefreshToken::TYPE;

        $token = new RefreshToken($client, $user, $ttl, $type);

        $this->assertSame($client, $token->getClient());
        $this->assertSame($user, $token->getUser());
        $this->assertEquals($type, $token->getType());
        $this->assertInstanceOf(\DateTimeInterface::class, $token->getCreatedAt());
        $this->assertInstanceOf(\DateTimeInterface::class, $token->getExpiresAt());
        $this->assertGreaterThan(0, $token->getExpiresIn());
        $this->assertFalse($token->isExpired());
        $this->assertArrayHasKey('access_token', $token->jsonSerialize());
        $this->assertEquals($token->getToken(), $token->jsonSerialize()['access_token']);
    }
}
