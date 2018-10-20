<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/oauth2-server Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Thingston\OAuth2\Server\Error;

/**
 * Invalid request error.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class InvalidRequestError extends Error
{

    /**
     * Create new instance.
     *
     * @param string $description
     * @param string $code
     * @param int $status
     * @param string $uri
     */
    public function __construct(string $description, string $code = ErrorInterface::INVALID_REQUEST_CODE, int $status = ErrorInterface::INVALID_REQUEST_STATUS, string $uri = ErrorInterface::DEFAULT_URI)
    {
        parent::__construct($code, $status, $description, $uri);
    }
}
