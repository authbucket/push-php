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
        $applicationId = substr(md5(uniqid(null, true)), 0, 8);
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $content = $this->app['serializer']->encode(array(
            'variantType' => 'apns',
            'applicationId' => $applicationId,
            'options' => array(),
        ), 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/variant.json', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($applicationId, $response['applicationId']);
    }

    public function testCreateActionXml()
    {
        $applicationId = substr(md5(uniqid(null, true)), 0, 8);
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $content = $this->app['serializer']->encode(array(
            'variantType' => 'apns',
            'applicationId' => $applicationId,
            'options' => array(),
        ), 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/variant.xml', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($applicationId, $response['applicationId']);
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
        $this->assertEquals('6b44c21ef7bc8ca7380bb5b8276b3f97', $response['applicationId']);
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
        $this->assertEquals('6b44c21ef7bc8ca7380bb5b8276b3f97', $response['applicationId']);
    }

    public function testUpdateActionJson()
    {
        $applicationId = substr(md5(uniqid(null, true)), 0, 8);
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $content = $this->app['serializer']->encode(array(
            'variantType' => 'apns',
            'applicationId' => $applicationId,
            'options' => array(),
        ), 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/variant.json', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($applicationId, $response['applicationId']);

        $id = $response['id'];
        $applicationIdUpdated = substr(md5(uniqid(null, true)), 0, 8);
        $content = $this->app['serializer']->encode(array('applicationId' => $applicationIdUpdated), 'json');
        $client = $this->createClient();
        $crawler = $client->request('PUT', "/api/v1.0/variant/${id}.json", array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($applicationIdUpdated, $response['applicationId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/api/v1.0/variant/${id}.json", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($applicationIdUpdated, $response['applicationId']);
    }

    public function testUpdateActionXml()
    {
        $applicationId = substr(md5(uniqid(null, true)), 0, 8);
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $content = $this->app['serializer']->encode(array(
            'variantType' => 'apns',
            'applicationId' => $applicationId,
            'options' => array(),
        ), 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/variant.xml', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($applicationId, $response['applicationId']);

        $id = $response['id'];
        $applicationIdUpdated = substr(md5(uniqid(null, true)), 0, 8);
        $content = $this->app['serializer']->encode(array('applicationId' => $applicationIdUpdated), 'xml');
        $client = $this->createClient();
        $crawler = $client->request('PUT', "/api/v1.0/variant/${id}.xml", array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($applicationIdUpdated, $response['applicationId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/api/v1.0/variant/${id}.xml", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($applicationIdUpdated, $response['applicationId']);
    }

    public function testDeleteActionJson()
    {
        $applicationId = substr(md5(uniqid(null, true)), 0, 8);
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $content = $this->app['serializer']->encode(array(
            'variantType' => 'apns',
            'applicationId' => $applicationId,
            'options' => array(),
        ), 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/variant.json', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($applicationId, $response['applicationId']);

        $id = $response['id'];
        $client = $this->createClient();
        $crawler = $client->request('DELETE', "/api/v1.0/variant/${id}.json", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals(null, $response['id']);
        $this->assertEquals($applicationId, $response['applicationId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/api/v1.0/variant/${id}.json", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals(null, $response);
    }

    public function testDeleteActionXml()
    {
        $applicationId = substr(md5(uniqid(null, true)), 0, 8);
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $content = $this->app['serializer']->encode(array(
            'variantType' => 'apns',
            'applicationId' => $applicationId,
            'options' => array(),
        ), 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/variant.xml', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($applicationId, $response['applicationId']);

        $id = $response['id'];
        $client = $this->createClient();
        $crawler = $client->request('DELETE', "/api/v1.0/variant/${id}.xml", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals(null, $response['id']);
        $this->assertEquals($applicationId, $response['applicationId']);

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
        $this->assertEquals('6b44c21ef7bc8ca7380bb5b8276b3f97', $response[0]['applicationId']);
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
        $this->assertEquals('6b44c21ef7bc8ca7380bb5b8276b3f97', $response[0]['applicationId']);
    }
}
