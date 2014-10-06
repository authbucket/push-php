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
use AuthBucket\Push\VariantType\VariantTypeHandlerFactoryInterface;
use AuthBucket\Push\Validator\Constraints\VariantType;
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
    protected $variantTypeHandlerFactory;

    public function __construct(
        ValidatorInterface $validator,
        ModelManagerFactoryInterface $modelManagerFactory,
        VariantTypeHandlerFactoryInterface $variantTypeHandlerFactory
    ) {
        $this->validator = $validator;
        $this->modelManagerFactory = $modelManagerFactory;
        $this->variantTypeHandlerFactory = $variantTypeHandlerFactory;
    }

    public function registerAction(Request $request)
    {
        // Check variant_type.
        $variantType = $this->checkVariantType($request);

        // Handle action.
        return $this->variantTypeHandlerFactory
            ->getVariantTypeHandler($variantType)
            ->register($request);
    }

    public function unregisterAction(Request $request)
    {
        // Check variant_type.
        $variantType = $this->checkVariantType($request);

        // Handle action.
        return $this->variantTypeHandlerFactory
            ->getVariantTypeHandler($variantType)
            ->unregister($request);
    }

    public function sendAction(Request $request)
    {
        $response = array();
        foreach ($this->variantTypeHandlerFactory->getVariantTypeHandlers() as $key => $value) {
            $response[$key] = $this->variantTypeHandlerFactory
                ->getVariantTypeHandler($key)
                ->send($request);
        }

        return new Response(json_encode($response));
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

    protected function checkVariantType(Request $request)
    {
        // Fetch variant_type from POST
        $variantType = $request->request->get('variant_type');
        $errors = $this->validator->validateValue($variantType, array(
            new NotBlank(),
            new VariantType(),
        ));
        if (count($errors) > 0) {
            throw new InvalidRequestException(array(
                'error_description' => 'The request includes an invalid parameter value.',
            ));
        }

        return $variantType;
    }
}
