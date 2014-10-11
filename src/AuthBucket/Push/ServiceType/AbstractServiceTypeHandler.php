<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\ServiceType;

use AuthBucket\Push\Model\ModelManagerFactoryInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;

/**
 * Shared service type implementation.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
abstract class AbstractServiceTypeHandler implements ServiceTypeHandlerInterface
{
    protected $securityContext;
    protected $validator;
    protected $modelManagerFactory;

    public function __construct(
        SecurityContextInterface $securityContext,
        ValidatorInterface $validator,
        ModelManagerFactoryInterface $modelManagerFactory
    ) {
        $this->securityContext = $securityContext;
        $this->validator = $validator;
        $this->modelManagerFactory = $modelManagerFactory;
    }
}
