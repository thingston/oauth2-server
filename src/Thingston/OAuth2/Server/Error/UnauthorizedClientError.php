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

/**
 * Unauthorized client error.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class UnauthorizedClientError extends Error
{

    /**
     * Create new instance.
     *
     * @param string $description
     * @param string $code
     * @param int $status
     * @param string $uri
     */
    public function __construct(string $description, string $code = ErrorInterface::UNAUTHORIZED_CLIENT_CODE, int $status = ErrorInterface::INVALID_REQUEST_STATUS, string $uri = 'https://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html')
    {
        parent::__construct($code, $status, $description, $uri);
    }
}
