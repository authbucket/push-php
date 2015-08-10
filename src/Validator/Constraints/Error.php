<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Validator\Constraints;

use Symfony\Component\Validator\Constraints\Regex;

/**
 * @Annotation
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class Error extends Regex
{
    public function __construct($options = null)
    {
        return parent::__construct(array_merge(array(
            'message' => 'This is not a valid error.',
            'pattern' => '/^([\x21\x22-\x5B\x5D-\x7E]+)$/',
        ), (array) $options));
    }
}
