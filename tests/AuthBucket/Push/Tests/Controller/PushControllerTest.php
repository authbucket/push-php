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
    public function testExceptionRegisterUnsupportedServiceType()
    {
        $parameters = array(
            'device_token' => 'demodevicetoken1',
            'service_type' => 'unsupported_service_type',
        );
        $server = array(
            'HTTP_Authorization' => implode(' ', array('Bearer', 'eeb5aa92bbb4b56373b9e0d00bc02d93')),
        );
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/push/register', $parameters, array(), $server);
        $this->assertEquals(400, $client->getResponse()->getStatusCode());
        $deviceResponse = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('unsupported_service_type', $deviceResponse['error']);
    }

    public function testGoodRegisterApns()
    {
        $parameters = array(
            'device_token' => 'e2db93d13228fb7c97d3bda74a61f478',
            'service_type' => 'apns',
        );
        $server = array(
            'HTTP_Authorization' => implode(' ', array('Bearer', 'eeb5aa92bbb4b56373b9e0d00bc02d93')),
        );
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/push/register', $parameters, array(), $server);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $deviceResponse = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('e2db93d13228fb7c97d3bda74a61f478', $deviceResponse['device_token']);
        $this->assertEquals('apns', $deviceResponse['service_type']);
    }

    public function testGoodRegisterGcm()
    {
        $parameters = array(
            'device_token' => 'e2db93d13228fb7c97d3bda74a61f478',
            'service_type' => 'gcm',
        );
        $server = array(
            'HTTP_Authorization' => implode(' ', array('Bearer', 'eeb5aa92bbb4b56373b9e0d00bc02d93')),
        );
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/push/register', $parameters, array(), $server);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $deviceResponse = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('e2db93d13228fb7c97d3bda74a61f478', $deviceResponse['device_token']);
        $this->assertEquals('gcm', $deviceResponse['service_type']);
    }

    public function testGoodUnregisterApns()
    {
        $parameters = array(
            'device_token' => 'eeb5aa92bbb4b56373b9e0d00bc02d93',
            'service_type' => 'apns',
        );
        $server = array(
            'HTTP_Authorization' => implode(' ', array('Bearer', 'eeb5aa92bbb4b56373b9e0d00bc02d93')),
        );
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/push/unregister', $parameters, array(), $server);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $modelManagerFactory = $this->app['authbucket_push.model_manager.factory'];
        $this->assertEmpty($modelManagerFactory->getModelManager('device')
            ->readModelBy(array(
                'deviceToken' => 'eeb5aa92bbb4b56373b9e0d00bc02d93',
            )));
    }

    public function testGoodUnregisterGcm()
    {
        $parameters = array(
            'device_token' => '7be07f1e5e1737f2aec000a0cc82da06',
            'service_type' => 'gcm',
        );
        $server = array(
            'HTTP_Authorization' => implode(' ', array('Bearer', 'eeb5aa92bbb4b56373b9e0d00bc02d93')),
        );
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/push/unregister', $parameters, array(), $server);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $modelManagerFactory = $this->app['authbucket_push.model_manager.factory'];
        $this->assertEmpty($modelManagerFactory->getModelManager('device')
            ->readModelBy(array(
                'deviceToken' => '7be07f1e5e1737f2aec000a0cc82da06',
            )));
    }

    public function testGoodCron()
    {
        $parameters = array();
        $server = array(
            'HTTP_Authorization' => implode(' ', array('Bearer', 'eeb5aa92bbb4b56373b9e0d00bc02d93')),
        );
        $client = $this->createClient();
        $crawler = $client->request('GET', '/api/v1.0/push/cron', $parameters, array(), $server);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $modelManagerFactory = $this->app['authbucket_push.model_manager.factory'];
        $this->assertEmpty($modelManagerFactory->getModelManager('device')
            ->readModelBy(array(
                'deviceToken' => '0027956241e3ca5090de548fe468334d',
            )));
        $this->assertEmpty($modelManagerFactory->getModelManager('device')
            ->readModelBy(array(
                'deviceToken' => '9e0d8519fc205595bd895fbf70addcad',
            )));
    }
}
