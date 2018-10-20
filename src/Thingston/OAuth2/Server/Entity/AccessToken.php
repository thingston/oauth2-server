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
 * Access token entity.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class AccessToken implements TokenInterface
{

    const TYPE = 'bearer';
    const TTL = 3600; // 1 hour

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
    public function __construct(ClientInterface $client, UserInterface $user = null, RefreshToken $refreshToken = null, int $ttl = self::TTL, string $type = self::TYPE)
    {
        $this->client = $client;
        $this->user = $user;
        $this->refreshToken = $refreshToken;
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
        $data = [
            'access_token' => $this->token,
            'token_type' => $this->type,
            'expires_in' => $this->getExpiresIn(),
        ];

        if (null !== $this->refreshToken) {
            $data['refresh_token'] = $this->refreshToken->getToken();
        }

        return $data;
    }
}
