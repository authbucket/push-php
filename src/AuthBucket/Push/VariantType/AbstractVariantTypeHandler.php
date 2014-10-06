<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\VariantType;

use AuthBucket\Push\Exception\InvalidRequestException;
use AuthBucket\Push\Exception\ServerErrorException;
use AuthBucket\Push\Model\ModelManagerFactoryInterface;
use AuthBucket\Push\Validator\Constraints\DeviceToken;
use AuthBucket\Push\Validator\Constraints\VariantType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\ValidatorInterface;

/**
 * Shared variant type implementation.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
abstract class AbstractVariantTypeHandler implements VariantTypeHandlerInterface
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

    protected function checkApplicationId()
    {
        return '6b44c21ef7bc8ca7380bb5b8276b3f97';

#        $token = $this->securityContext->getToken();
#        if ($token === null || !$token instanceof AccessTokenToken) {
#            throw new ServerErrorException(array(
#                'error_description' => 'The authorization server encountered an unexpected condition that prevented it from fulfilling the request.',
#            ));
#        }
#
#        return $token->getClientId();
    }

    protected function checkUsername()
    {
        return 'demouserame1';

#        $token = $this->securityContext->getToken();
#        if ($token === null || !$token instanceof AccessTokenToken) {
#            throw new ServerErrorException(array(
#                'error_description' => 'The authorization server encountered an unexpected condition that prevented it from fulfilling the request.',
#            ));
#        }
#
#        return $token->getUsername();
    }

    protected function checkDeviceToken(Request $request)
    {
        // device_token is required and in valid format.
        $deviceToken = $request->request->get('device_token');
        $errors = $this->validator->validateValue($deviceToken, array(
            new NotBlank(),
            new DeviceToken(),
        ));
        if (count($errors) > 0) {
            throw new InvalidRequestException(array(
                'error_description' => 'The request includes an invalid parameter value.',
            ));
        }

        return $deviceToken;
    }

    protected function checkData(Request $request)
    {
        // Fetch data from POST body.
        $data = $request->request->all();

        return $data;
    }
}
