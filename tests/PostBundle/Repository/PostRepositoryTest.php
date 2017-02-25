<?php

/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 25.02.17
 * Time: 21:18
 */
namespace PostBundle\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PostRepositoryTest extends KernelTestCase
{
    private $em;

    protected function setUp()
    {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testGetPostById()
    {
        $post =  $this->em
            ->getRepository('PostBundle:Post')
            ->getPostById(1);

        $this->assertNotEmpty($post);
        $this->assertCount(1, [$post]);
        $this->assertEquals(1, $post->getId());
        $this->assertNotEquals(12, $post->getId());
        $this->assertEquals('name', $post->getName());
        $this->assertNotEquals('aaaa', $post->getName());
        $this->assertEquals('description', $post->getDescription());
        $this->assertNotEquals('aaaa', $post->getDescription());

        $this->assertObjectHasAttribute('id', $post);
        $this->assertObjectHasAttribute('name', $post);
        $this->assertObjectHasAttribute('description', $post);
    }

    public function testGetAllPost()
    {
        $postList =  $this->em
            ->getRepository('PostBundle:Post')
            ->getAllPost();

        $this->assertNotEmpty($postList);
        $this->assertCount(3, $postList);

        foreach ($postList as $post) {
            $this->assertObjectHasAttribute('id', $post);
            $this->assertObjectHasAttribute('name', $post);
            $this->assertObjectHasAttribute('description', $post);
        }
    }
}