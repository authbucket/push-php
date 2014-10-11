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

class ServiceControllerTest extends WebTestCase
{
    public function testCreateActionJson()
    {
        $serviceId = md5(uniqid(null, true));
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $content = $this->app['serializer']->encode(array(
            'serviceId' => $serviceId,
            'serviceType' => 'apns',
            'clientId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'options' => array(),
        ), 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/service.json', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($serviceId, $response['serviceId']);
    }

    public function testCreateActionXml()
    {
        $serviceId = md5(uniqid(null, true));
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $content = $this->app['serializer']->encode(array(
            'serviceId' => $serviceId,
            'serviceType' => 'apns',
            'clientId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'options' => array(),
        ), 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/service.xml', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($serviceId, $response['serviceId']);
    }

    public function testReadActionJson()
    {
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $client = $this->createClient();
        $crawler = $client->request('GET', '/api/v1.0/service/1.json', array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals('f2ee1d163e9c9b633efca95fb9733f35', $response['serviceId']);
    }

    public function testReadActionXml()
    {
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $client = $this->createClient();
        $crawler = $client->request('GET', '/api/v1.0/service/1.xml', array(), array(), $server);
        $response = simplexml_load_string($client->getResponse()->getContent());
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals('f2ee1d163e9c9b633efca95fb9733f35', $response['serviceId']);
    }

    public function testUpdateActionJson()
    {
        $serviceId = md5(uniqid(null, true));
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $content = $this->app['serializer']->encode(array(
            'serviceId' => $serviceId,
            'serviceType' => 'apns',
            'clientId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'options' => array(),
        ), 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/service.json', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($serviceId, $response['serviceId']);

        $id = $response['id'];
        $serviceIdUpdated = md5(uniqid(null, true));
        $content = $this->app['serializer']->encode(array('serviceId' => $serviceIdUpdated), 'json');
        $client = $this->createClient();
        $crawler = $client->request('PUT', "/api/v1.0/service/${id}.json", array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($serviceIdUpdated, $response['serviceId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/api/v1.0/service/${id}.json", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($serviceIdUpdated, $response['serviceId']);
    }

    public function testUpdateActionXml()
    {
        $serviceId = md5(uniqid(null, true));
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $content = $this->app['serializer']->encode(array(
            'serviceId' => $serviceId,
            'serviceType' => 'apns',
            'clientId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'options' => array(),
        ), 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/service.xml', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($serviceId, $response['serviceId']);

        $id = $response['id'];
        $serviceIdUpdated = md5(uniqid(null, true));
        $content = $this->app['serializer']->encode(array('serviceId' => $serviceIdUpdated), 'xml');
        $client = $this->createClient();
        $crawler = $client->request('PUT', "/api/v1.0/service/${id}.xml", array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($serviceIdUpdated, $response['serviceId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/api/v1.0/service/${id}.xml", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($serviceIdUpdated, $response['serviceId']);
    }

    public function testDeleteActionJson()
    {
        $serviceId = md5(uniqid(null, true));
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $content = $this->app['serializer']->encode(array(
            'serviceId' => $serviceId,
            'serviceType' => 'apns',
            'clientId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'options' => array(),
        ), 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/service.json', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($serviceId, $response['serviceId']);

        $id = $response['id'];
        $client = $this->createClient();
        $crawler = $client->request('DELETE', "/api/v1.0/service/${id}.json", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals(null, $response['id']);
        $this->assertEquals($serviceId, $response['serviceId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/api/v1.0/service/${id}.json", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals(null, $response);
    }

    public function testDeleteActionXml()
    {
        $serviceId = md5(uniqid(null, true));
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $content = $this->app['serializer']->encode(array(
            'serviceId' => $serviceId,
            'serviceType' => 'apns',
            'clientId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'options' => array(),
        ), 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/service.xml', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($serviceId, $response['serviceId']);

        $id = $response['id'];
        $client = $this->createClient();
        $crawler = $client->request('DELETE', "/api/v1.0/service/${id}.xml", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals(null, $response['id']);
        $this->assertEquals($serviceId, $response['serviceId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/api/v1.0/service/${id}.xml", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals(null, $response);
    }

    public function testListActionJson()
    {
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $client = $this->createClient();
        $crawler = $client->request('GET', '/api/v1.0/service.json', array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals('f2ee1d163e9c9b633efca95fb9733f35', $response[0]['serviceId']);
    }

    public function testListActionXml()
    {
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $client = $this->createClient();
        $crawler = $client->request('GET', '/api/v1.0/service.xml', array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals('f2ee1d163e9c9b633efca95fb9733f35', $response[0]['serviceId']);
    }
}
