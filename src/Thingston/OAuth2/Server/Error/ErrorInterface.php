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
 * Error interface.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
interface ErrorInterface extends JsonSerializable
{

    /**
     * Error codes
     */
    const INVALID_REQUEST_CODE = 'invalid_request';
    const INVALID_REQUEST_STATUS = 400;
    const UNAUTHORIZED_CLIENT_CODE = 'unauthorized_client';
    const UNAUTHORIZED_CLIENT_STATUS = 401;
    const ACCESS_DENIED_CODE = 'access_denied';
    const ACCESS_DENIED_STATUS = 403;
    const METHOD_NOT_ALLOWED_CODE = 'method_not-allowed';
    const METHOD_NOT_ALLOWED_STATUS = 405;
    const UNSUPPORTED_RESPONSE_TYPE_CODE = 'unsupported_response_type';
    const UNSUPPORTED_RESPONSE_TYPE_STATUS = 406;
    const INVALID_SCOPE_CODE = 'invalid_scope';
    const INVALID_SCOPE_STATUS = 404;
    const SERVER_ERROR_CODE = 'server_error';
    const SERVER_ERROR_STATUS = 500;
    const TEMPORARILY_UNAVAILABLE_CODE = 'temporarily_unavailable';
    const TEMPORARILY_UNAVAILABLE_STATUS = 503;

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode(): string;

    /**
     * Get HTTP status.
     *
     * @return int
     */
    public function getStatus(): int;

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getUri(): ?string;
}
