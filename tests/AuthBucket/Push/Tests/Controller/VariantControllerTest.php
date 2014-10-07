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
        $variantId = md5(uniqid(null, true));
        $variantSecret = md5(uniqid(null, true));
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $content = $this->app['serializer']->encode(array(
            'variantId' => $variantId,
            'variantSecret' => $variantSecret,
            'variantType' => 'apns',
            'applicationId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'options' => array(),
        ), 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/variant.json', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($variantId, $response['variantId']);
    }

    public function testCreateActionXml()
    {
        $variantId = md5(uniqid(null, true));
        $variantSecret = md5(uniqid(null, true));
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $content = $this->app['serializer']->encode(array(
            'variantId' => $variantId,
            'variantSecret' => $variantSecret,
            'variantType' => 'apns',
            'applicationId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'options' => array(),
        ), 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/variant.xml', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($variantId, $response['variantId']);
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
        $this->assertEquals('f2ee1d163e9c9b633efca95fb9733f35', $response['variantId']);
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
        $this->assertEquals('f2ee1d163e9c9b633efca95fb9733f35', $response['variantId']);
    }

    public function testUpdateActionJson()
    {
        $variantId = md5(uniqid(null, true));
        $variantSecret = md5(uniqid(null, true));
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $content = $this->app['serializer']->encode(array(
            'variantId' => $variantId,
            'variantSecret' => $variantSecret,
            'variantType' => 'apns',
            'applicationId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'options' => array(),
        ), 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/variant.json', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($variantId, $response['variantId']);

        $id = $response['id'];
        $variantIdUpdated = md5(uniqid(null, true));
        $content = $this->app['serializer']->encode(array('variantId' => $variantIdUpdated), 'json');
        $client = $this->createClient();
        $crawler = $client->request('PUT', "/api/v1.0/variant/${id}.json", array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($variantIdUpdated, $response['variantId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/api/v1.0/variant/${id}.json", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($variantIdUpdated, $response['variantId']);
    }

    public function testUpdateActionXml()
    {
        $variantId = md5(uniqid(null, true));
        $variantSecret = md5(uniqid(null, true));
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $content = $this->app['serializer']->encode(array(
            'variantId' => $variantId,
            'variantSecret' => $variantSecret,
            'variantType' => 'apns',
            'applicationId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'options' => array(),
        ), 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/variant.xml', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($variantId, $response['variantId']);

        $id = $response['id'];
        $variantIdUpdated = md5(uniqid(null, true));
        $content = $this->app['serializer']->encode(array('variantId' => $variantIdUpdated), 'xml');
        $client = $this->createClient();
        $crawler = $client->request('PUT', "/api/v1.0/variant/${id}.xml", array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($variantIdUpdated, $response['variantId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/api/v1.0/variant/${id}.xml", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($variantIdUpdated, $response['variantId']);
    }

    public function testDeleteActionJson()
    {
        $variantId = md5(uniqid(null, true));
        $variantSecret = md5(uniqid(null, true));
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $content = $this->app['serializer']->encode(array(
            'variantId' => $variantId,
            'variantSecret' => $variantSecret,
            'variantType' => 'apns',
            'applicationId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'options' => array(),
        ), 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/variant.json', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($variantId, $response['variantId']);

        $id = $response['id'];
        $client = $this->createClient();
        $crawler = $client->request('DELETE', "/api/v1.0/variant/${id}.json", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals(null, $response['id']);
        $this->assertEquals($variantId, $response['variantId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/api/v1.0/variant/${id}.json", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals(null, $response);
    }

    public function testDeleteActionXml()
    {
        $variantId = md5(uniqid(null, true));
        $variantSecret = md5(uniqid(null, true));
        $server = array(
            'PHP_AUTH_USER' => 'demousername1',
            'PHP_AUTH_PW' => 'demopassword1',
        );
        $content = $this->app['serializer']->encode(array(
            'variantId' => $variantId,
            'variantSecret' => $variantSecret,
            'variantType' => 'apns',
            'applicationId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'options' => array(),
        ), 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/api/v1.0/variant.xml', array(), array(), $server, $content);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($variantId, $response['variantId']);

        $id = $response['id'];
        $client = $this->createClient();
        $crawler = $client->request('DELETE', "/api/v1.0/variant/${id}.xml", array(), array(), $server);
        $response = $this->app['serializer']->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals(null, $response['id']);
        $this->assertEquals($variantId, $response['variantId']);

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
        $this->assertEquals('f2ee1d163e9c9b633efca95fb9733f35', $response[0]['variantId']);
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
        $this->assertEquals('f2ee1d163e9c9b633efca95fb9733f35', $response[0]['variantId']);
    }
}
