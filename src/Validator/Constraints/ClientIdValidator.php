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

use Symfony\Component\Validator\Constraints\RegexValidator;

/**
 * Validates whether the value is a valid client_id per RFC 6749.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * @see http://tools.ietf.org/html/rfc6749#appendix-A.1
 */
class ClientIdValidator extends RegexValidator
{
}
