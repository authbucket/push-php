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
 * AccessDeniedException.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class AccessDeniedException extends \LogicException implements ExceptionInterface
{
    public function __construct($message = [], $code = 403, Exception $previous = null)
    {
        $message['error'] = 'access_denied';
        parent::__construct(serialize($message), $code, $previous);
    }
}
