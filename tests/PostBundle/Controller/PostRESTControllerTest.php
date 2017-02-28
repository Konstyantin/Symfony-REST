<?php
/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 28.02.17
 * Time: 19:20
 */

namespace PostBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostRESTControllerTest extends WebTestCase
{
    public function testGetAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/posts/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $crawler = $client->request('GET', '/posts/100');

        $this->assertEquals(500, $client->getResponse()->getStatusCode());
    }

    public function testCgetAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/posts');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testPostAction()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/posts', [], [], ['CONTENT_TYPE' => 'application/json'],
            '{
	            "name" : "test update 18 patch posts",
                "description" : "Description for test post"
            }'
        );

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function testPutAction()
    {
        $client = static::createClient();

        $crawler = $client->request('PUT', '/posts/36', [], [], ['CONTENT_TYPE' => 'application/json'],
            '{
	            "name" : "test update 3 patch posts",
                "description" : "Description for test post"
            }'
        );

        $this->assertEquals(204, $client->getResponse()->getStatusCode());
    }

    public function testPatchAction()
    {
        $client = static::createClient();

        $crawler = $client->request('PATCH', '/posts/36', [], [], ['CONTENT_TYPE' => 'application/json'],
            '{
	            "name" : "test update 3 patch method posts",
                "description" : "Description for test post"
            }'
        );

        $this->assertEquals(204, $client->getResponse()->getStatusCode());
    }

    public function testDeleteAction()
    {
        $client = static::createClient();

        $crawler = $client->request('DELETE', '/posts/36');

        $this->assertEquals(204, $client->getResponse()->getStatusCode());
    }
}