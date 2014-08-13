<?php

/**
 * This file is part of the authbucket/push package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Tests\TestBundle\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class DemoController
{
    public function demoIndexAction(Request $request, Application $app)
    {
        return $app['twig']->render('demo/index.html.twig');
    }
}
