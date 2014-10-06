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

class VariantControllerTest extends WebTestCase
{
    public function testCreateActionJson()
    {
        $clientId = substr(md5(uniqid(null, true)), 0, 8);
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $content = $this->app['serializer']->encode(array(
            'variantType' => 'apns',
            'clientId' => $clientId,
            'options' => array(),
        ), 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/variant.json', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($clientId, $response['clientId']);
    }

    public function testCreateActionXml()
    {
        $clientId = substr(md5(uniqid(null, true)), 0, 8);
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $content = $this->app['serializer']->encode(array(
            'variantType' => 'apns',
            'clientId' => $clientId,
            'options' => array(),
        ), 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/variant.xml', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($clientId, $response['clientId']);
    }

    public function testReadActionJson()
    {
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $client = $this->createClient();
        $crawler = $client->request('GET', '/api/v1.0/variant/1.json', array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals('http://democlient1.com/', $response['clientId']);
    }

    public function testReadActionXml()
    {
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $client = $this->createClient();
        $crawler = $client->request('GET', '/api/v1.0/variant/1.xml', array(), array(), $server);
        $response = simplexml_load_string($client->getResponse()->getContent());
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals('http://democlient1.com/', $response['clientId']);
    }

    public function testUpdateActionJson()
    {
        $clientId = substr(md5(uniqid(null, true)), 0, 8);
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $content = $this->app['serializer']->encode(array(
            'variantType' => 'apns',
            'clientId' => $clientId,
            'options' => array(),
        ), 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/variant.json', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($clientId, $response['clientId']);

        $id = $response['id'];
        $clientIdUpdated = substr(md5(uniqid(null, true)), 0, 8);
        $content = $this->app['serializer']->encode(array('clientId' => $clientIdUpdated), 'json');
        $client = $this->createClient();
        $crawler = $client->request('PUT', "/api/v1.0/variant/${id}.json", array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($clientIdUpdated, $response['clientId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/api/v1.0/variant/${id}.json", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($clientIdUpdated, $response['clientId']);
    }

    public function testUpdateActionXml()
    {
        $clientId = substr(md5(uniqid(null, true)), 0, 8);
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $content = $this->app['serializer']->encode(array(
            'variantType' => 'apns',
            'clientId' => $clientId,
            'options' => array(),
        ), 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/variant.xml', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($clientId, $response['clientId']);

        $id = $response['id'];
        $clientIdUpdated = substr(md5(uniqid(null, true)), 0, 8);
        $content = $this->app['serializer']->encode(array('clientId' => $clientIdUpdated), 'xml');
        $client = $this->createClient();
        $crawler = $client->request('PUT', "/api/v1.0/variant/${id}.xml", array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($clientIdUpdated, $response['clientId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/api/v1.0/variant/${id}.xml", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($clientIdUpdated, $response['clientId']);
    }

    public function testDeleteActionJson()
    {
        $clientId = substr(md5(uniqid(null, true)), 0, 8);
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $content = $this->app['serializer']->encode(array(
            'variantType' => 'apns',
            'clientId' => $clientId,
            'options' => array(),
        ), 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/variant.json', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($clientId, $response['clientId']);

        $id = $response['id'];
        $client = $this->createClient();
        $crawler = $client->request('DELETE', "/api/v1.0/variant/${id}.json", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals(null, $response['id']);
        $this->assertEquals($clientId, $response['clientId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/api/v1.0/variant/${id}.json", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals(null, $response);
    }

    public function testDeleteActionXml()
    {
        $clientId = substr(md5(uniqid(null, true)), 0, 8);
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $content = $this->app['serializer']->encode(array(
            'variantType' => 'apns',
            'clientId' => $clientId,
            'options' => array(),
        ), 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/variant.xml', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($clientId, $response['clientId']);

        $id = $response['id'];
        $client = $this->createClient();
        $crawler = $client->request('DELETE', "/api/v1.0/variant/${id}.xml", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals(null, $response['id']);
        $this->assertEquals($clientId, $response['clientId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/api/v1.0/variant/${id}.xml", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals(null, $response);
    }

    public function testListActionJson()
    {
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $client = $this->createClient();
        $crawler = $client->request('GET', '/api/v1.0/variant.json', array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals('http://democlient1.com/', $response[0]['clientId']);
    }

    public function testListActionXml()
    {
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $client = $this->createClient();
        $crawler = $client->request('GET', '/api/v1.0/variant.xml', array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals('http://democlient1.com/', $response[0]['clientId']);
    }
}
