<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/oauth2-server Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace ThingstonTest\OAuth2\Server;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Thingston\OAuth2\Server\AuthorizationServer;
use Thingston\OAuth2\Server\Grant;
use Thingston\OAuth2\Server\Http\ErrorResponse;
use Thingston\OAuth2\Server\Http\TokenResponse;

/**
 * Authorization server test case.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class AuthorizationServerTest extends TestCase
{

    public function testGrantsCollection()
    {
        $server = new AuthorizationServer();
        $this->assertEmpty($server->getGrants());

        $grant = $this->getMockBuilder(Grant\GrantInterface::class)->getMock();
        $key = md5(get_class($grant));
        $grant->expects($this->any())->method('getKey')->willReturn($key);

        $server->addGrant($grant);
        $this->assertEquals(1, count($server->getGrants()));

        $server->removeGrant($grant);
        $this->assertEquals(0, count($server->getGrants()));
    }

    public function testAddGrantsOnConstructor()
    {
        $grant = $this->getMockBuilder(Grant\GrantInterface::class)->getMock();
        $key = md5(get_class($grant));
        $grant->expects($this->any())->method('getKey')->willReturn($key);

        $server = new AuthorizationServer([$grant]);
        $this->assertEquals(1, count($server->getGrants()));
    }

    public function testResolveReturnsNullOnBadMethod()
    {
        $request = $this->getMockBuilder(ServerRequestInterface::class)->getMock();
        $server = new AuthorizationServer();
        $this->assertNull($server->resolve($request));
    }

    public function testResolveReturnsNullOnMissingResponseType()
    {
        $request = $this->getMockBuilder(ServerRequestInterface::class)->getMock();
        $request->expects($this->any())->method('getMethod')->willReturn('GET');
        $request->expects($this->any())->method('getQueryParams')->willReturn([]);
        $server = new AuthorizationServer();
        $this->assertNull($server->resolve($request));
    }

    public function testResolveReturnsNullOnMissingGrantType()
    {
        $request = $this->getMockBuilder(ServerRequestInterface::class)->getMock();
        $request->expects($this->any())->method('getMethod')->willReturn('POST');
        $request->expects($this->any())->method('getParsedBody')->willReturn([]);
        $server = new AuthorizationServer();
        $this->assertNull($server->resolve($request));
    }

    public function testResolveReturnsClienCredentialsGrant()
    {
        $request = $this->getMockBuilder(ServerRequestInterface::class)->getMock();
        $request->expects($this->any())->method('getMethod')->willReturn('POST');
        $request->expects($this->any())->method('getParsedBody')->willReturn(['grant_type' => Grant\ClientCredentialsGrant::GRANT_TYPE]);

        $grant = $this->getMockBuilder(Grant\ClientCredentialsGrant::class)->disableOriginalConstructor()->getMock();
        $grant->expects($this->any())->method('getGrantType')->willReturn(Grant\ClientCredentialsGrant::GRANT_TYPE);

        $server = new AuthorizationServer([$grant]);

        $this->assertSame($grant, $server->resolve($request));
    }

    public function testHandleInvalidRequest()
    {
        $request = $this->getMockBuilder(ServerRequestInterface::class)->getMock();
        $server = new AuthorizationServer();

        $this->assertInstanceOf(ErrorResponse::class, $server->handle($request));
    }

    public function testHandleRequest()
    {
        $request = $this->getMockBuilder(ServerRequestInterface::class)->getMock();
        $request->expects($this->any())->method('getMethod')->willReturn('POST');
        $request->expects($this->any())->method('getParsedBody')->willReturn(['grant_type' => Grant\ClientCredentialsGrant::GRANT_TYPE]);

        $response = $this->getMockBuilder(TokenResponse::class)->disableOriginalConstructor()->getMock();

        $grant = $this->getMockBuilder(Grant\ClientCredentialsGrant::class)->disableOriginalConstructor()->getMock();
        $grant->expects($this->any())->method('getGrantType')->willReturn(Grant\ClientCredentialsGrant::GRANT_TYPE);
        $grant->expects($this->once())->method('token')->willReturn($response);

        $server = new AuthorizationServer([$grant]);

        $this->assertSame($response, $server->handle($request));
    }
}
