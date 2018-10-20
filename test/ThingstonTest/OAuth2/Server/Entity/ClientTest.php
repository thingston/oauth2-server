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
}
