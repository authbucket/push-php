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
use Symfony\Component\HttpFoundation\Request;

class PushController
{
    public function pushIndexAction(Request $request, Application $app)
    {
        return $app['twig']->render('push/index.html.twig');
    }

    public function pushLoginAction(Request $request, Application $app)
    {
        $session = $request->getSession();

        $error = $app['security.last_error']($request);
        $_username = $session->get('_username');
        $_password = $session->get('_password');

        return $app['twig']->render('push/login.html.twig', array(
            'error' => $error,
            '_username' => $_username,
            '_password' => $_password,
        ));
    }
}
