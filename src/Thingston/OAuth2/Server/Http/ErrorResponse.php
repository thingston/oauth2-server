<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/crawler Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Thingston\OAuth2\Server\Http;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Thingston\OAuth2\Server\Error\ErrorInterface;

/**
 * Error response.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class ErrorResponse extends Response implements ResponseInterface
{

    /**
     * Create new instance.
     *
     * @param ErrorInterface $error
     */
    public function __construct(ErrorInterface $error)
    {
        $headers = ['Content-Type' => 'application/json'];
        parent::__construct($error->getStatus(), $headers, $error->jsonSerialize());
    }

}
