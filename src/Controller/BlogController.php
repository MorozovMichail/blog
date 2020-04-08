<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Blog;
use App\Entity\Comment;
use App\Form\CommentType;
/**
 * Blog controller.
 */
class BlogController extends AbstractController
{
    /**
     * Show a blog entry
     */
    public function showAction($id, $slug)
    {   //Выво одной строки в таблице
        $em = $this->getDoctrine()->getManager();

        $blog = $em->getRepository(blog::class)->find($id);

        if (!$blog) {
            throw $this->createNotFoundException(
                'Unable to find Blog post.');
        }

        $comments = $em->getRepository(Comment::class)
            ->getCommentsForblog($blog->getId());


 //      return new Response('Check out this great product: '.$blog->getTitle());
        return $this->render('blog/show.html.twig', [
           'blog'      => $blog,
            'comments'  => $comments
     ]);



//       $blog = $em->getRepository('Blog')->find($id);

//       if (!$blog) {
//           throw $this->createNotFoundException('Unable to find Blog post.');
//       }

//        return $this->render('blog/show.html.twig', [
//            'blog'      => $blog,
//       ]);



    }
}
