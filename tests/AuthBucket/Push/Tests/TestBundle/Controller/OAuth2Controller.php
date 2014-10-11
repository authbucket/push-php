<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Tests\TestBundle\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class OAuth2Controller
{
    public function debugAction(Request $request, Application $app)
    {
        $accessTokenManager = $app['authbucket_oauth2.model_manager.factory']->getModelManager('access_token');
        $className = $accessTokenManager->getClassName();

        $model = new $className();
        $model->setAccessToken('18cdaa6481c0d5f323351ea1029fc065')
            ->setTokenType('bearer')
            ->setClientId('6b44c21ef7bc8ca7380bb5b8276b3f97')
            ->setUsername('demousername1')
            ->setExpires(new \DateTime('+10 years'))
            ->setScope(array(
                'demoscope1',
            ));
        $accessTokenManager->createModel($model);

        $tokenHeaders = $request->headers->get('Authorization', false);
        if ($tokenHeaders && preg_match('/Bearer\s*([^\s]+)/', $tokenHeaders, $matches)) {
            $tokenHeaders = $matches[1];
        } else {
            $tokenHeaders = false;
        }
        $tokenRequest = $request->request->get('access_token', false);
        $tokenQuery = $request->query->get('access_token', false);

        $accessToken = $tokenHeaders
            ?: $tokenRequest
            ?: $tokenQuery;
        $accessTokenAuthenticated = $accessTokenManager->readModelOneBy(array(
            'accessToken' => $accessToken,
        ));

        $parameters = array(
            'access_token' => $accessTokenAuthenticated->getAccessToken(),
            'token_type' => $accessTokenAuthenticated->getTokenType(),
            'client_id' => $accessTokenAuthenticated->getClientId(),
            'username' => $accessTokenAuthenticated->getUsername(),
            'expires' => $accessTokenAuthenticated->getExpires()->getTimestamp(),
            'scope' => $accessTokenAuthenticated->getScope(),
        );

        return JsonResponse::create($parameters, 200, array(
            'Cache-Control' => 'no-store',
            'Pragma' => 'no-cache',
        ));
    }
}
