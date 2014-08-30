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

class DeviceControllerTest extends WebTestCase
{
    public function testExceptionUnsupportedServiceType()
    {
        $parameters = array(
            'device_token' => 'demodevicetoken1',
            'service_type' => 'unsupported_service_type',
        );
        $server = array(
            'HTTP_Authorization' => implode(' ', array('Bearer', 'eeb5aa92bbb4b56373b9e0d00bc02d93')),
        );
        $client = $this->createClient();
        $crawler = $client->request('POST', '/push/device', $parameters, array(), $server);
        $this->assertEquals(400, $client->getResponse()->getStatusCode());
        $deviceResponse = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('unsupported_service_type', $deviceResponse['error']);
    }

    public function testGoodApns()
    {
        $parameters = array(
            'device_token' => 'e2db93d13228fb7c97d3bda74a61f478',
            'service_type' => 'apns',
        );
        $server = array(
            'HTTP_Authorization' => implode(' ', array('Bearer', 'eeb5aa92bbb4b56373b9e0d00bc02d93')),
        );
        $client = $this->createClient();
        $crawler = $client->request('POST', '/push/device', $parameters, array(), $server);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $deviceResponse = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('e2db93d13228fb7c97d3bda74a61f478', $deviceResponse['device_token']);
        $this->assertEquals('apns', $deviceResponse['service_type']);
    }

    public function testGoodGcm()
    {
        $parameters = array(
            'device_token' => 'e2db93d13228fb7c97d3bda74a61f478',
            'service_type' => 'gcm',
        );
        $server = array(
            'HTTP_Authorization' => implode(' ', array('Bearer', 'eeb5aa92bbb4b56373b9e0d00bc02d93')),
        );
        $client = $this->createClient();
        $crawler = $client->request('POST', '/push/device', $parameters, array(), $server);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $deviceResponse = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('e2db93d13228fb7c97d3bda74a61f478', $deviceResponse['device_token']);
        $this->assertEquals('gcm', $deviceResponse['service_type']);
    }
}
