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

use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Uri;
use PHPUnit\Framework\TestCase;
use Thingston\OAuth2\Server\Http\ClientCredentialsRequest;

/**
 * Client credentials request test case.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class ClientCredentialsRequestTest extends TestCase
{

    public function testRequestWithoutCredentials()
    {
        $uri = new Uri('http://example.org');
        $request = new ClientCredentialsRequest(new ServerRequest('GET', $uri));

        $this->assertNull($request->getId());
        $this->assertNull($request->getSecret());

        $this->assertNull($request->getId());
        $this->assertNull($request->getSecret());
        $this->assertFalse($request->hasClient());
    }

    public function testRequestWithAuthorizationHeader()
    {
        $uri = new Uri('http://example.org');
        $headers = ['Authorization' => ['Basic foo:bar']];
        $request = new ClientCredentialsRequest(new ServerRequest('GET', $uri, $headers));

        $this->assertEquals('foo', $request->getId());
        $this->assertEquals('bar', $request->getSecret());
        $this->assertTrue($request->hasClient());
    }

    public function testRequestWithEmptyAuthorizationHeader()
    {
        $uri = new Uri('http://example.org');
        $headers = ['Authorization' => []];
        $request = new ClientCredentialsRequest(new ServerRequest('GET', $uri, $headers));

        $this->assertNull($request->getId());
        $this->assertNull($request->getSecret());
        $this->assertFalse($request->hasClient());
    }

    public function testRequestWithBadAuthorizationHeader()
    {
        $uri = new Uri('http://example.org');
        $headers = ['Authorization' => ['bearer jdhfaiu7487rhf4f7rhc']];
        $request = new ClientCredentialsRequest(new ServerRequest('GET', $uri, $headers));

        $this->assertNull($request->getId());
        $this->assertNull($request->getSecret());
        $this->assertFalse($request->hasClient());
    }

    public function testRequestWithEmptyHash()
    {
        $uri = new Uri('http://example.org');
        $headers = ['Authorization' => ['Basic ']];
        $request = new ClientCredentialsRequest(new ServerRequest('GET', $uri, $headers));

        $this->assertNull($request->getId());
        $this->assertNull($request->getSecret());
        $this->assertFalse($request->hasClient());
    }

    public function testRequestWithUserinfo()
    {
        $uri = new Uri('http://foo:bar@example.org');
        $request = new ClientCredentialsRequest(new ServerRequest('GET', $uri));

        $this->assertEquals('foo', $request->getId());
        $this->assertEquals('bar', $request->getSecret());
    }

    public function testRequestWithBodyParams()
    {
        $uri = new Uri('http://example.org');
        $mock = $this->getMockBuilder(ServerRequest::class)->disableOriginalConstructor()->getMock();
        $mock->expects($this->any())->method('getUri')->willReturn($uri);
        $mock->expects($this->any())->method('getParsedBody')->willReturn(['client_id' => 'foo', 'client_secret' => 'bar']);
        $request = new ClientCredentialsRequest($mock);

        $this->assertEquals('bar', $request->getSecret());
        $this->assertEquals('foo', $request->getId());
    }
}
