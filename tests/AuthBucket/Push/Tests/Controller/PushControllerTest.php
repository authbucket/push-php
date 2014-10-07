<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Tests\Controller;

use AuthBucket\Push\Tests\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class PushControllerTest extends WebTestCase
{
    public function testGoodRegisterJson()
    {
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $content = $this->app['serializer']->encode(array(
            'deviceToken' => '0027956241e3ca5090de548fe468334d',
            'variantId' => 'f2ee1d163e9c9b633efca95fb9733f35',
        ), 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/push/register.json', array(), array(), $server, $content);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals('0027956241e3ca5090de548fe468334d', $response['deviceToken']);
    }

    public function testGoodRegisterXml()
    {
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $content = $this->app['serializer']->encode(array(
            'deviceToken' => '0027956241e3ca5090de548fe468334d',
            'variantId' => 'f2ee1d163e9c9b633efca95fb9733f35',
        ), 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/push/register.xml', array(), array(), $server, $content);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals('0027956241e3ca5090de548fe468334d', $response['deviceToken']);
    }
}
