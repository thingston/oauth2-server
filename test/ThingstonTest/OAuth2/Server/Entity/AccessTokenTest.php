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
use Thingston\OAuth2\Server\Entity\AccessToken;
use Thingston\OAuth2\Server\Entity\ClientInterface;
use Thingston\OAuth2\Server\Entity\RefreshToken;
use Thingston\OAuth2\Server\Entity\UserInterface;

/**
 * Access token test case.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class AccessTokenTest extends TestCase
{

    public function testAccessTokenState()
    {
        $client = $this->getMockBuilder(ClientInterface::class)->getMock();
        $user = $this->getMockBuilder(UserInterface::class)->getMock();
        $refreshToken = new RefreshToken($client, $user);
        $ttl = AccessToken::TTL;
        $type = AccessToken::TYPE;

        $token = new AccessToken($client, $user, $refreshToken, $ttl, $type);

        $this->assertSame($client, $token->getClient());
        $this->assertSame($user, $token->getUser());
        $this->assertSame($refreshToken, $token->getRefreshToken());
        $this->assertEquals($type, $token->getType());
        $this->assertInstanceOf(\DateTimeInterface::class, $token->getCreatedAt());
        $this->assertInstanceOf(\DateTimeInterface::class, $token->getExpiresAt());
        $this->assertGreaterThan(0, $token->getExpiresIn());
        $this->assertFalse($token->isExpired());
        $this->assertArrayHasKey('access_token', $token->jsonSerialize());
        $this->assertEquals($token->getToken(), $token->jsonSerialize()['access_token']);
    }
}
