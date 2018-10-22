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
use Thingston\OAuth2\Server\Entity\Client;
use Thingston\OAuth2\Server\Entity\Scope;

/**
 * Client test case.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class ClientTest extends TestCase
{

    public function testClientState()
    {
        $id = uniqid();
        $secret = sha1(uniqid(random_bytes(128)));

        $client = new Client($id, $secret);

        $this->assertEquals($id, $client->getId());
        $this->assertEquals($secret, $client->getSecret());
        $this->assertTrue($client->isConfidential());

        $id = uniqid();
        $secret = sha1(uniqid(random_bytes(128)));

        $client->setId($id)->setSecret($secret);

        $this->assertEquals($id, $client->getId());
        $this->assertEquals($secret, $client->getSecret());
    }

    public function testClientSecret()
    {
        $id = uniqid();
        $secret = sha1(uniqid(random_bytes(128)));

        $client = new Client($id, Client::encrypt($secret));

        $this->assertTrue($client->verify($secret));
    }

    public function testClientType()
    {
        $id = uniqid();
        $secret = sha1(uniqid(random_bytes(128)));

        $client = new Client($id, $secret);

        $client->setConfidential();
        $this->assertTrue($client->isConfidential());
        $this->assertFalse($client->isPublic());

        $client->setPublic();
        $this->assertTrue($client->isPublic());
        $this->assertFalse($client->isConfidential());
    }

    public function testRedirectUri()
    {
        $id = uniqid();
        $secret = sha1(uniqid(random_bytes(128)));
        $uri = 'http://example.org';

        $client = new Client($id, $secret);

        $this->assertFalse($client->hasRedirectUri($uri));
        $this->assertEmpty($client->getRedirectUris());

        $client->addRedirectUri($uri);
        $this->assertTrue($client->hasRedirectUri($uri));
        $this->assertCount(1, $client->getRedirectUris());

        $client->removeRedirectUri($uri);
        $this->assertFalse($client->hasRedirectUri($uri));
        $this->assertCount(0, $client->getRedirectUris());
    }

    public function testScope()
    {
        $id = uniqid();
        $secret = sha1(uniqid(random_bytes(128)));
        $scope = new Scope('scope');

        $client = new Client($id, $secret);

        $this->assertFalse($client->hasScope($scope));
        $this->assertEmpty($client->getScopes());

        $client->addScope($scope);
        $this->assertTrue($client->hasScope($scope));
        $this->assertCount(1, $client->getScopes());

        $client->removeScope($scope);
        $this->assertFalse($client->hasScope($scope));
        $this->assertCount(0, $client->getScopes());
    }
}
