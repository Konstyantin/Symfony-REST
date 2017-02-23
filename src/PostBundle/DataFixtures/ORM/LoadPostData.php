<?php

/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 23.02.17
 * Time: 11:51
 */
namespace PostBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PostBundle\Entity\Post;

/**
 * Class LoadPostData are used to load a set of post data into database,
 * and used for testing or could be initial data required for the application to run smoothly.
 *
 * @package CategoryBundle\DataFixtures\ORM
 */
class LoadPostData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Allow you to run creating fixture
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $post = new Post();
        $post->setName('name');
        $post->setDescription('description');

        $manager->persist($post);
        $manager->flush();
    }

    /**
     * Allowing to set order in which fixtures are loaded
     *
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}