<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/ Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Thingston\OAuth2\Server\Error;

use JsonSerializable;

/**
 * Abstract error class.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class Error implements ErrorInterface, JsonSerializable
{

    /**
     * @var string
     */
    private $code;

    /**
     * @var int
     */
    private $status;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $uri;

    /**
     * Create new instance.
     *
     * @param string $code
     * @param int $status
     * @param string $description
     * @param string $uri
     */
    public function __construct(string $code, int $status, string $description = null, string $uri = null)
    {
        $this->code = $code;
        $this->status = $status;
        $this->description = $description;
        $this->uri = $uri;
    }

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Get HTTP status.
     *
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getUri(): ?string
    {
        return $this->uri;
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $data = ['error' => $this->code];

        if (true === isset($this->description)) {
            $data['description'] = $this->description;
        }

        if (true === isset($this->uri)) {
            $data['uri'] = $this->uri;
        }

        return $data;
    }
}