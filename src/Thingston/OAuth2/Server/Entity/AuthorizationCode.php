<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/oauth2-server Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Thingston\OAuth2\Server\Entity;

/**
 * Authorization code entity.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class AuthorizationCode implements TokenInterface
{

    const TYPE = 'code';
    const TTL = 600; // 10 minutes

    use TokenTrait;

    /**
     * Create new instance.
     *
     * @param ClientInterface $client
     * @param UserInterface $user
     * @param RefreshToken $refreshToken
     * @param int $ttl
     * @param string $type
     */
    public function __construct(ClientInterface $client, UserInterface $user, int $ttl = self::TTL, string $type = self::TYPE)
    {
        $this->client = $client;
        $this->user = $user;
        $this->type = $type;

        $this->init($ttl);
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @see http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return array
     */
    public function jsonSerialize(): array
    {
        return ['code' => $this->token];
    }
}
