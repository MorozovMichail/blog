<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Blog;
use App\Entity\Comment;
use App\Form\AddBlogType;
use App\Form\CommentType;



/**
 * AddBlog Controller.
 * @Route("/api", name="api_")
 */
class AddBlogController extends FOSRestController
{

    /**
     * Lists all Blogs.
     * @Rest\Get("/blogs")
     *
     * @return Response
     */
    public function getBlogAction()
    {
        $repository=$this->getDoctrine()->getRepository(Blog::class);
        $blogs=$repository->findall();

        return $this->handleView($this->view($blogs));
    }

    /**
     * Create Blog.
     * @Rest\Post("/blog")
     *
     * @return Response
     */

    public function postBlogAction(Request $request)
    {
        $blog = new Blog();
        $form = $this->createForm(AddBlogType::class, $blog);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($blog);
            $em->flush();
            return $this->handleView($this->view(['status' => 'ok'],Response::HTTP_CREATED));
        }

        return $this->handleView($this->view($form->getErrors()));
    }





    /**
     * Create Comment.
     * @Rest\Post("/{blog_id}/comment")
     *
     * @return Response
     */

    public function postcommentAction(Request $request, $blog_id)
    {
        $blog = $this->getBlog($blog_id);

        $comment  = new Comment();
        $comment->setBlog($blog);
        $form    = $this->createForm(CommentType::class, $comment);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            // TODO: Persist the comment entity
            $em = $this->getDoctrine()
                ->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->handleView($this->view(['status' => 'ok'],Response::HTTP_CREATED));
        }

        return $this->handleView($this->view($form->getErrors()));
    }

    protected function getBlog($blog_id)
    {
        $em = $this->getDoctrine()
            ->getManager();

        $blog = $em->getRepository(blog::class)->find($blog_id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $blog;
    }




    /**
     * Change Blog.
     * @Rest\Put("/blog/{blog_id}")
     *
     * @return Response
     */

    public function putblogAction(Request $request, $blog_id)
    {



        $blog = $this->getBlog($blog_id);
        $form = $this->createForm(AddBlogType::class, $blog);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($blog);
            $em->flush();
            return $this->handleView($this->view(['status' => 'ok'],Response::HTTP_OK));
        }

        return $this->handleView($this->view($form->getErrors()));
    }
    /**
     * Change Comment.
     * @Rest\Put("/{blog_id}/{comment_id}")
     *
     * @return Response
     */


    public function putcommentAction(Request $request,$comment_id, $blog_id)
    {
        $blog= $this->getDoctrine()
            ->getRepository(Blog::class)
            ->find($blog_id);

        $comment = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->find($comment_id);

      if($blog->getTitle() == $comment->getBlog())
      {

            $form = $this->createForm(CommentType::class, $comment);
            $data = json_decode($request->getContent(), true);
            $form->submit($data);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()
                    ->getManager();
                $em->persist($comment);
                $em->flush();
                return $this->handleView($this->view(['status' =>  'ok'],Response::HTTP_OK));
            }

            return $this->handleView($this->view($form->getErrors()));
        }

    }

    /**
     * Delete Blog.
     * @Rest\Delete("/{blog_id}")
     *
     * @return Response
     */
    public function deleteBlogAction(Request $request,$blog_id)
    {
        $blog= $this->getDoctrine()
            ->getRepository(Blog::class)
            ->find($blog_id);
            $em=$this->getDoctrine()->getManager();
            $em->remove($blog);
            $em->flush();
            return $this->handleView($this->view(['status' => 'ok'],Response::HTTP_OK));



    }

    /**
     * Delete Comment.
     * @Rest\Delete("/{blog_id}/{comment_id}")
     *
     * @return Response
     */

    public function deleteCommentAction(Request $request,$comment_id,$blog_id)
    {
        $blog= $this->getDoctrine()
            ->getRepository(Blog::class)
            ->find($blog_id);


        $comment= $this->getDoctrine()
        ->getRepository(Comment::class)
        ->find($comment_id);
        if($blog->getTitle() == $comment->getBlog())
        {

            $em = $this->getDoctrine()->getManager();
            $em->remove($comment);
            $em->flush();
            return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_OK));

        }

    }


}
