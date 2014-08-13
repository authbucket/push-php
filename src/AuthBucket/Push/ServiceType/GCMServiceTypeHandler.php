<?php

/**
 * This file is part of the authbucket/push package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\ServiceType;

use AuthBucket\Push\Model\ModelManagerFactoryInterface;
use AuthBucket\Push\TokenType\TokenTypeHandlerFactoryInterface;
use AuthBucket\Push\Util\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * Code service type handler implementation.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class GCMServiceTypeHandler extends AbstractServiceTypeHandler
{
    public function handle(
        SecurityContextInterface $securityContext,
        Request $request,
        ModelManagerFactoryInterface $modelManagerFactory,
        TokenTypeHandlerFactoryInterface $tokenTypeHandlerFactory
    )
    {
        // Fetch username from authenticated token.
        $username = $this->checkUsername($securityContext);

        // Fetch and check client_id.
        $clientId = $this->checkClientId($request, $modelManagerFactory);

        // Fetch and check redirect_uri.
        $redirectUri = $this->checkRedirectUri($request, $modelManagerFactory, $clientId);

        // Fetch and check state.
        $state = $this->checkState($request, $redirectUri);

        // Fetch and check scope.
        $scope = $this->checkScope(
            $request,
            $modelManagerFactory,
            $clientId,
            $username,
            $redirectUri,
            $state
        );

        // Generate parameters, store to backend and set service.
        $modelManager =  $modelManagerFactory->getModelManager('code');
        $code = $modelManager->createCode()
            ->setCode(md5(uniqid(null, true)))
            ->setState($state)
            ->setClientId($clientId)
            ->setUsername($username)
            ->setRedirectUri($redirectUri)
            ->setExpires(new \DateTime('+10 minutes'))
            ->setScope($scope);
        $modelManager->updateCode($code);

        $parameters = array(
            'code' => $code->getCode(),
            'state' => $state,
        );

        return RedirectResponse::create($redirectUri, $parameters);
    }
}
