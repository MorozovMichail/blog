<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Blog;
/**
 * Blog controller.
 */
class BlogController extends AbstractController
{
    /**
     * Show a blog entry
     * @Route("/{id}", name="product_show")
     */
    public function showAction($id)
    {   //Выво одной строки в таблице
        $blog=$this->getDoctrine()
        ->getRepository(blog::class)
        ->find($id);

        if (!$blog) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
 //      return new Response('Check out this great product: '.$blog->getTitle());
        return $this->render('blog/show.html.twig', [
           'blog'      => $blog,
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
