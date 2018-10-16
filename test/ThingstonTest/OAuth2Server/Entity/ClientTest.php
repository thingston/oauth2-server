<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/crawler Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace ThingstonTest\OAuth2Server\Entity;

use PHPUnit\Framework\TestCase;
use Thingston\OAuth2Server\Entity\Client;

/**
 * Client test case.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class ClientTest extends TestCase
{
    public function testClient()
    {
        $id = uniqid();
        $secret = sha1(random_bytes(128));

        $client = new Client($id, $secret);

        $this->assertEquals($id, $client->getId());
        $this->assertEquals($secret, $client->getSecret());

        $id = uniqid();
        $secret = sha1(random_bytes(128));

        $client->setId($id)->setSecret($secret);
        
        $this->assertEquals($id, $client->getId());
        $this->assertEquals($secret, $client->getSecret());
    }
}
