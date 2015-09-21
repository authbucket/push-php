<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Exception;

/**
 * ServerErrorException.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class ServerErrorException extends \LogicException implements ExceptionInterface
{
    public function __construct($message = [], $code = 500, Exception $previous = null)
    {
        $message['error'] = 'server_error';
        parent::__construct(serialize($message), $code, $previous);
    }
}
