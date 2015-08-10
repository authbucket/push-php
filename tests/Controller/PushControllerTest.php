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
    public function testGoodRegisterAction()
    {
        $parameters = array(
            'device_token' => '0027956241e3ca5090de548fe468334d',
            'service_id' => 'f2ee1d163e9c9b633efca95fb9733f35',
        );
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $client = $this->createClient();
        $crawler = $client->request('POST', '/dummy/v1.0/push/register', $parameters, array(), $server);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('0027956241e3ca5090de548fe468334d', $response['device_token']);
    }

    public function testGoodUnrgisterAction()
    {
        $parameters = array(
            'device_token' => '0027956241e3ca5090de548fe468334d',
            'service_id' => 'f2ee1d163e9c9b633efca95fb9733f35',
        );
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $client = $this->createClient();
        $crawler = $client->request('POST', '/dummy/v1.0/push/unregister', $parameters, array(), $server);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('0027956241e3ca5090de548fe468334d', $response['device_token']);
    }

    public function testGoodSendAction()
    {
        $parameters = array(
            'alert' => '6fb577c6fce866c7c06a95c7f9010d85',
        );
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $client = $this->createClient();
        $crawler = $client->request('POST', '/dummy/v1.0/push/send', $parameters, array(), $server);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('6fb577c6fce866c7c06a95c7f9010d85', $response['payload']['alert']);
    }
}
