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
use AuthBucket\Push\Model\ModelManagerFactoryInterface;
use AuthBucket\Push\ServiceType\ServiceTypeHandlerFactoryInterface;
use AuthBucket\Push\Validator\Constraints\ServiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    protected $modelManagerFactory;
    protected $serviceTypeHandlerFactory;

    public function __construct(
        ValidatorInterface $validator,
        ModelManagerFactoryInterface $modelManagerFactory,
        ServiceTypeHandlerFactoryInterface $serviceTypeHandlerFactory
    )
    {
        $this->validator = $validator;
        $this->modelManagerFactory = $modelManagerFactory;
        $this->serviceTypeHandlerFactory = $serviceTypeHandlerFactory;
    }

    public function registerAction(Request $request)
    {
        // Check service_type.
        $serviceType = $this->checkServiceType($request);

        // Handle action.
        return $this->serviceTypeHandlerFactory
            ->getServiceTypeHandler($serviceType)
            ->register($request);
    }

    public function unregisterAction(Request $request)
    {
        // Check service_type.
        $serviceType = $this->checkServiceType($request);

        // Handle action.
        return $this->serviceTypeHandlerFactory
            ->getServiceTypeHandler($serviceType)
            ->unregister($request);
    }

    public function sendAction(Request $request)
    {
        // Check service_type.
        $serviceType = $this->checkServiceType($request);

        // Handle action.
        return $this->serviceTypeHandlerFactory
            ->getServiceTypeHandler($serviceType)
            ->send($request);
    }

    public function cronAction(Request $request)
    {
        $limit = 100;

        foreach (array('device') as $type) {
            $modelManager = $this->modelManagerFactory->getModelManager($type);

            $offset = 0;
            while (count($models = $modelManager->readModelBy(array(), array(), $limit, $offset)) > 0) {
                $offset += $limit;

                foreach ($models as $model) {
                    if ($model->getExpires() < new \DateTime()) {
                        $modelManager->deleteModel($model);
                        $offset--;
                    }
                }
            }
        }

        return new Response();
    }

    protected function checkServiceType(Request $request)
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

        return $serviceType;
    }
}
