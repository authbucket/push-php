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
 * InvalidRequestException.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class InvalidRequestException extends \InvalidArgumentException implements ExceptionInterface
{
    public function __construct($message = [], $code = 400, Exception $previous = null)
    {
        $message['error'] = 'invalid_request';
        parent::__construct(serialize($message), $code, $previous);
    }
}
