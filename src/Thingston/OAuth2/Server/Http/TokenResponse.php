<?php

/**
 * Thingston OAuth2 Server
 *
 * @version 0.1.0
 * @link https://github.com/thingston/oauth2-server Public Git repository
 * @copyright (c) 2018, Pedro Ferreira <https://thingston.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Thingston\OAuth2\Server\Http;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Thingston\OAuth2\Server\Token\TokenInterface;

/**
 * Token response.
 *
 * @author Pedro Ferreira <pedro@thingston.com>
 */
class TokenResponse extends Response implements ResponseInterface
{

    /**
     * Create new instance.
     *
     * @param TokenInterface $token
     */
    public function __construct(TokenInterface $token)
    {
        $headers = ['Content-Type' => 'application/json'];
        parent::__construct($token->getStatus(), $headers, $token->jsonSerialize());
    }
}
