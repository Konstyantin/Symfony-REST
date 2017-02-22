<?php
/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 22.02.17
 * Time: 22:57
 */

namespace PostBundle\Controller;

use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use PostBundle\Form\PostType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * Class PostRESTController
 * @package PostBundle\Controller
 *
 * @RouteResource("post")
 */
class PostRESTController extends FOSRestController implements ClassResourceInterface
{
    /**
     * Get one Post by $id
     *
     * @param int $id
     * @return mixed
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * @ApiDoc(
     *     output="PostBundle\Entity\Post",
     *     statusCodes={
     *          200 = "Return when success",
     *          404 = "Return when not found"
     *     }
     * )
     */
    public function getAction(int $id)
    {
        $post = $this->get('post_repository')->getPostById($id);

        if ($post === null) {
            return new View(null, Response::HTTP_NOT_FOUND);
        }

        return $post;
    }

    /**
     * Get a collection of Posts
     *
     * @return array
     *
     * @ApiDoc(
     *     output="PostBundle\Entity\Post",
     *     statusCodes={
     *          200 = "Return when success",
     *          404 = "Return when not found"
     *     }
     * )
     */
    public function cgetAction()
    {
        return $this->get('post_repository')->getAllPost();
    }

    /**
     * Create new Post
     *
     * @param Request $request
     * @return \Symfony\Component\Form\Form|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @ApiDoc(
     *     input = "PostBundle\Form\PostType",
     *     output="PostBundle\Entity\Post",
     *     statusCodes={
     *          201 = "Return when success",
     *          404 = "Return when not found"
     *     }
     * )
     */
    public function postAction(Request $request)
    {
        $form = $this->createForm(PostType::class);

        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $form;
        }

        $postData = $form->getData();

        $em = $this->getDoctrine()->getManager();
        $em->persist($postData);
        $em->flush();

        $routeOptions = [
            'id' => $postData->getId(),
            '_format' => $request->get('_format'),
        ];

        return $this->routeRedirectView('get_post', $routeOptions, Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @param $id
     * @return View|\Symfony\Component\Form\Form
     *
     * @ApiDoc(
     *     input = "PostBundle\Form\PostType",
     *     output="PostBundle\Entity\Post",
     *     statusCodes={
     *          204 = "Returned when an existing Post has been successful updated",
     *          400 = "Return when errors",
     *          404 = "Return when not found"
     *     }
     * )
     */
    public function putAction(Request $request, int $id)
    {
        $post = $this->get('post_repository')->getPostById($id);

        $form = $this->createForm(PostType::class, $post);

        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $form;
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $routeOptions = [
            'id' => $post->getId(),
            '_format' => $request->get('_format'),
        ];

        return $this->routeRedirectView('get_post', $routeOptions, Response::HTTP_NO_CONTENT);
    }

    /**
     * Delete select Post
     *
     * @param int $id
     * @return View
     *
     * @ApiDoc(
     *     output="PostBundle\Entity\Post",
     *     statusCodes={
     *          204 = "Returned when an existing Post has been successful deleted",
     *          404 = "Return when not found"
     *     }
     * )
     */
    public function deleteAction(int $id)
    {
        $post = $this->get('post_repository')->getPostById($id);

        if ($post === null) {
            return new View(null, Response::HTTP_NOT_FOUND);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        return new View(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Update exist Post
     *
     * @param Request $request
     * @param $id
     * @return View|\Symfony\Component\Form\Form
     *
     * @ApiDoc(
     *     input = "PostBundle\Form\PostType",
     *     output="PostBundle\Entity\Post",
     *     statusCodes={
     *          204 = "Returned when an existing Post has been successful updated",
     *          400 = "Return when errors",
     *          404 = "Return when not found"
     *     }
     * )
     */
    public function patchAction(Request $request, int $id)
    {
        $post = $this->get('post_repository')->getPostById($id);

        $form = $this->createForm(PostType::class, $post);

        $form->submit($request->request->all(), false);

        if (!$form->isValid()) {
            return $form;
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $routeOptions = [
            'id' => $post->getId(),
            '_format' => $request->get('_format'),
        ];

        return $this->routeRedirectView('get_post', $routeOptions, Response::HTTP_NO_CONTENT);
    }
}