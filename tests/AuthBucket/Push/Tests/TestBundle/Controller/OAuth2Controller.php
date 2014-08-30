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
        $model->setAccessToken('eeb5aa92bbb4b56373b9e0d00bc02d93')
            ->setTokenType('bearer')
            ->setClientId('http://democlient1.com/')
            ->setUsername('demousername1')
            ->setExpires(new \DateTime('+10 years'))
            ->setScope(array(
                'demoscope1',
            ));
        $accessTokenManager->createModel($model);

        $model = new $className();
        $model->setAccessToken('d2b58c4c6bc0cc9fefca2d558f1221a5')
            ->setTokenType('bearer')
            ->setClientId('http://democlient1.com/')
            ->setUsername('demousername1')
            ->setExpires(new \DateTime('-1 hours'))
            ->setScope(array(
                'demoscope1',
            ));
        $accessTokenManager->createModel($model);

        $model = new $className();
        $model->setAccessToken('ba2e8d1f54ed3e3d96935796576f1a06')
            ->setTokenType('bearer')
            ->setClientId('http://democlient1.com/')
            ->setUsername('demousername1')
            ->setExpires(new \DateTime('+1 hours'))
            ->setScope(array(
                'demoscope1',
                'demoscope2',
            ));
        $accessTokenManager->createModel($model);

        $model = new $className();
        $model->setAccessToken('bcc105b66698a64ed23c87b967885289')
            ->setTokenType('bearer')
            ->setClientId('http://democlient1.com/')
            ->setUsername('demousername1')
            ->setExpires(new \DateTime('+1 hours'))
            ->setScope(array(
                'demoscope3',
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
