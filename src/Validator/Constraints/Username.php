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
class Username extends Regex
{
    public function __construct($options = null)
    {
        return parent::__construct(array_merge([
            'message' => 'This is not a valid username.',
            'pattern' => '/^([\x09\x20-\x7E\x80-\x{D7FF}\x{E000}-\x{FFFD}\x{10000}-\x{10FFFF}]*)$/u',
        ], (array) $options));
    }
}
