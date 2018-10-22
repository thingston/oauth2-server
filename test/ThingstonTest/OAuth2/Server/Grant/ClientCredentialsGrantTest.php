<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/oauth2-server Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace ThingstonTest\OAuth2\Server\Grant;

use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Uri;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Thingston\OAuth2\Server\Entity\AccessToken;
use Thingston\OAuth2\Server\Entity\Client;
use Thingston\OAuth2\Server\Grant\ClientCredentialsGrant;
use Thingston\OAuth2\Server\Http\ErrorResponse;
use Thingston\OAuth2\Server\Http\TokenResponse;
use Thingston\OAuth2\Server\Repository\ClientRepositoryInterface;
use Thingston\OAuth2\Server\Repository\TokenRepositoryInterface;

/**
 * Client credentials grant test case.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class ClientCredentialsGrantTest extends TestCase
{

    public function testGrantState()
    {
        $clientRepository = $this->getMockBuilder(ClientRepositoryInterface::class)->getMock();
        $tokenRepository = $this->getMockBuilder(TokenRepositoryInterface::class)->getMock();

        $ttl = AccessToken::TTL;
        $key = md5(ClientCredentialsGrant::class);

        $grant = new ClientCredentialsGrant($clientRepository, $tokenRepository, $ttl);

        $this->assertSame($clientRepository, $grant->getClientRepository());
        $this->assertSame($tokenRepository, $grant->getTokenRepository());
        $this->assertEquals($ttl, $grant->getTtl());
        $this->assertEquals($key, $grant->getKey());
        $this->assertEquals(ClientCredentialsGrant::GRANT_TYPE, $grant->getGrantType());
    }

    public function testAuthorizeResponse()
    {
        $clientRepository = $this->getMockBuilder(ClientRepositoryInterface::class)->getMock();
        $tokenRepository = $this->getMockBuilder(TokenRepositoryInterface::class)->getMock();
        $grant = new ClientCredentialsGrant($clientRepository, $tokenRepository);

        $request = $this->getMockBuilder(ServerRequestInterface::class)->getMock();

        $this->assertInstanceOf(ErrorResponse::class, $grant->authorize($request));
    }

    public function testTokenResponseWithMissingCredentials()
    {
        $clientRepository = $this->getMockBuilder(ClientRepositoryInterface::class)->getMock();
        $tokenRepository = $this->getMockBuilder(TokenRepositoryInterface::class)->getMock();
        $grant = new ClientCredentialsGrant($clientRepository, $tokenRepository);

        $uri = new Uri('http://example.org');
        $request = $this->getMockBuilder(ServerRequest::class)->disableOriginalConstructor()->getMock();
        $request->expects($this->any())->method('getUri')->willReturn($uri);

        $this->assertInstanceOf(ErrorResponse::class, $grant->token($request));
    }

    public function testTokenResponseWithMissingSecret()
    {
        $clientRepository = $this->getMockBuilder(ClientRepositoryInterface::class)->getMock();
        $tokenRepository = $this->getMockBuilder(TokenRepositoryInterface::class)->getMock();
        $grant = new ClientCredentialsGrant($clientRepository, $tokenRepository);

        $uri = new Uri('http://foo@example.org');
        $request = $this->getMockBuilder(ServerRequest::class)->disableOriginalConstructor()->getMock();
        $request->expects($this->any())->method('getUri')->willReturn($uri);

        $this->assertInstanceOf(ErrorResponse::class, $grant->token($request));
    }

    public function testTokenResponseWithClientNotFound()
    {
        $clientRepository = $this->getMockBuilder(ClientRepositoryInterface::class)->getMock();
        $tokenRepository = $this->getMockBuilder(TokenRepositoryInterface::class)->getMock();
        $grant = new ClientCredentialsGrant($clientRepository, $tokenRepository);

        $uri = new Uri('http://foo:bar@example.org');
        $request = $this->getMockBuilder(ServerRequest::class)->disableOriginalConstructor()->getMock();
        $request->expects($this->any())->method('getUri')->willReturn($uri);

        $this->assertInstanceOf(ErrorResponse::class, $grant->token($request));
    }

    public function testTokenResponseWithUnauthorizedClientType()
    {
        $client = new Client('foo', Client::encrypt('bar'), false);
        $clientRepository = $this->getMockBuilder(ClientRepositoryInterface::class)->getMock();
        $clientRepository->expects($this->any())->method('find')->willReturn($client);
        $tokenRepository = $this->getMockBuilder(TokenRepositoryInterface::class)->getMock();
        $grant = new ClientCredentialsGrant($clientRepository, $tokenRepository);

        $uri = new Uri('http://foo:bar@example.org');
        $request = $this->getMockBuilder(ServerRequest::class)->disableOriginalConstructor()->getMock();
        $request->expects($this->any())->method('getUri')->willReturn($uri);

        $this->assertInstanceOf(ErrorResponse::class, $grant->token($request));
    }

    public function testTokenResponseWithInvalidSecret()
    {
        $client = new Client('foo', Client::encrypt('baz'));
        $clientRepository = $this->getMockBuilder(ClientRepositoryInterface::class)->getMock();
        $clientRepository->expects($this->any())->method('find')->willReturn($client);
        $tokenRepository = $this->getMockBuilder(TokenRepositoryInterface::class)->getMock();
        $grant = new ClientCredentialsGrant($clientRepository, $tokenRepository);

        $uri = new Uri('http://foo:bar@example.org');
        $request = $this->getMockBuilder(ServerRequest::class)->disableOriginalConstructor()->getMock();
        $request->expects($this->any())->method('getUri')->willReturn($uri);

        $this->assertInstanceOf(ErrorResponse::class, $grant->token($request));
    }

    public function testTokenResponseWithValidCredentials()
    {
        $client = new Client('foo', Client::encrypt('bar'));
        $clientRepository = $this->getMockBuilder(ClientRepositoryInterface::class)->getMock();
        $clientRepository->expects($this->any())->method('find')->willReturn($client);
        $tokenRepository = $this->getMockBuilder(TokenRepositoryInterface::class)->getMock();
        $grant = new ClientCredentialsGrant($clientRepository, $tokenRepository);

        $uri = new Uri('http://foo:bar@example.org');
        $request = $this->getMockBuilder(ServerRequest::class)->disableOriginalConstructor()->getMock();
        $request->expects($this->any())->method('getUri')->willReturn($uri);

        $this->assertInstanceOf(TokenResponse::class, $grant->token($request));
    }
}
