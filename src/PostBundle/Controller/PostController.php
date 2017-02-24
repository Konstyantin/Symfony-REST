<?php

namespace PostBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostController extends Controller
{
    public function indexAction()
    {
        $posts = $this->get('post_repository')->getAllPost();
        return $this->render('@Post/Post/index.html.twig');
    }
}
