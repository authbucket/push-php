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
 * TemporarilyUnavailableException.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class TemporarilyUnavailableException extends \LogicException implements ExceptionInterface
{
    public function __construct($message = [], $code = 503, Exception $previous = null)
    {
        $message['error'] = 'temporarily_unavailable';
        parent::__construct(serialize($message), $code, $previous);
    }
}
