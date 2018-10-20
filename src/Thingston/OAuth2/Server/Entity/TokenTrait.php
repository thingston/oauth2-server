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

use DateTime;
use DateTimeInterface;

/**
 * token trait.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
trait TokenTrait
{

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @var TokenInterface
     */
    private $refreshToken;

    /**
     * @var DateTimeInterface
     */
    private $createdAt;

    /**
     * @var DateTimeInterface
     */
    private $expiresAt;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $type;

    /**
     * Initialize token.
     *
     * @param int $ttl
     */
    protected function init(int $ttl)
    {
        $this->createdAt = new DateTime();
        $this->expiresAt = new DateTime(date('c', time() + $ttl));
        $this->token = hash('sha256', uniqid(random_bytes(4096)));
    }

    /**
     * Get client.
     *
     * @return ClientInterface
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * Get user.
     *
     * @return UserInterface|null
     */
    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    /**
     * Get refresh token.
     *
     * @return TokenInterface|null
     */
    public function getRefreshToken(): ?TokenInterface
    {
        return $this->refreshToken;
    }

    /**
     * Get created at datetime.
     *
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * Get created at datetime.
     *
     * @return DateTimeInterface
     */
    public function getExpiresAt(): DateTimeInterface
    {
        return $this->expiresAt;
    }

    /**
     * Get expires in seconds.
     *
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expiresAt->getTimestamp() - time();
    }

    /**
     * Check either token is already expired.
     *
     * @return bool
     */
    public function isExpired(): bool
    {
        return 0 > $this->getExpiresIn();
    }

    /**
     * Get token.
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Get token type.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
