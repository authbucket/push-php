<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Controller;

use AuthBucket\Push\Exception\InvalidRequestException;
use AuthBucket\Push\ServiceType\ServiceTypeHandlerFactoryInterface;
use AuthBucket\Push\Validator\Constraints\ServiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\ValidatorInterface;

/**
 * Push device endpoint controller implementation.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class PushController
{
    protected $validator;
    protected $serviceTypeHandlerFactory;

    public function __construct(
        ValidatorInterface $validator,
        ServiceTypeHandlerFactoryInterface $serviceTypeHandlerFactory
    )
    {
        $this->validator = $validator;
        $this->serviceTypeHandlerFactory = $serviceTypeHandlerFactory;
    }

    public function registerAction(Request $request)
    {
        // Fetch service_type from POST
        $serviceType = $request->request->get('service_type');
        $errors = $this->validator->validateValue($serviceType, array(
            new NotBlank(),
            new ServiceType(),
        ));
        if (count($errors) > 0) {
            throw new InvalidRequestException(array(
                'error_description' => 'The request includes an invalid parameter value.',
            ));
        }

        // Handle device endpoint response.
        return $this->serviceTypeHandlerFactory
            ->getServiceTypeHandler($serviceType)
            ->register($request);
    }

    public function unregisterAction(Request $request)
    {
        return 'unregisterAction()';
    }

    public function sendAction(Request $request)
    {
        return 'sendAction()';
    }
}
