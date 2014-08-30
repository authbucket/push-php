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

use AuthBucket\Push\Exception\UnsupportedServiceTypeException;
use AuthBucket\Push\Model\ModelManagerFactoryInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;

/**
 * Push service type handler factory implemention.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class ServiceTypeHandlerFactory implements ServiceTypeHandlerFactoryInterface
{
    protected $securityContext;
    protected $validator;
    protected $modelManagerFactory;
    protected $classes;

    public function __construct(
        SecurityContextInterface $securityContext,
        ValidatorInterface $validator,
        ModelManagerFactoryInterface $modelManagerFactory,
        array $classes = array()
    )
    {
        $this->securityContext = $securityContext;
        $this->validator = $validator;
        $this->modelManagerFactory = $modelManagerFactory;

        foreach ($classes as $class) {
            if (!class_exists($class)) {
                throw new UnsupportedServiceTypeException(array(
                    'error_description' => 'The authorization server does not support obtaining an authorization code using this method.',
                ));
            }

            $reflection = new \ReflectionClass($class);
            if (!$reflection->implementsInterface('AuthBucket\\Push\\ServiceType\\ServiceTypeHandlerInterface')) {
                throw new UnsupportedServiceTypeException(array(
                    'error_description' => 'The authorization server does not support obtaining an authorization code using this method.',
                ));
            }
        }

        $this->classes = $classes;
    }

    public function getServiceTypeHandler($type = null)
    {
        $type = $type ?: current(array_keys($this->classes));

        if (!isset($this->classes[$type]) || !class_exists($this->classes[$type])) {
            throw new UnsupportedServiceTypeException(array(
                'error_description' => 'The authorization server does not support obtaining an authorization code using this method.',
            ));
        }

        $class = $this->classes[$type];

        return new $class(
            $this->securityContext,
            $this->validator,
            $this->modelManagerFactory
        );
    }
}
