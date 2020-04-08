<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
// Import new namespaces
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Enquiry;
use App\Form\EnquiryType;
use App\Entity\Blog;
use App\Entity\Comment;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $blogs = $em->getRepository(blog::class)
            ->getLatestBlogs();
        return $this->render('page/index.html.twig', [
            'blogs' => $blogs
            ]);
    }


    /**
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
         return $this->render('page/about.html.twig');
    }





    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request,\Swift_Mailer $mailer)
    {   /*         пример, для написания эл в ручную
        $entityManager = $this->getDoctrine()->getManager();

        $Enquiry = new Enquiry();
        $Enquiry->setName('Keyboard');
        $Enquiry->setSubject('Keyboard');
        $Enquiry->setBody('Ergonomic and stylish!');

        $entityManager->persist($Enquiry);

        $entityManager->flush();

        return new Response('Saved new product with id '.$Enquiry->getId());
        */
        $enquiry = new Enquiry();
        $form = $this->createForm(EnquiryType::class, $enquiry);




        if ($request->isMethod($request::METHOD_POST)) {
            $form->handleRequest($request);
        }



            if ($form->isSubmitted() && $form->isValid()) {

                $task = $form->getData();
                $em = $this->getDoctrine()->getManager();

                    $em->persist($task);


                $message = (new \Swift_Message('Hello Email'))
                    ->setSubject('Contact enquiry from symblog')
                    ->setFrom('morozovwork26@gmail.com')
                    ->setTo('misha260100@mail.ru')
                    ->setBody($this->renderView(
                    'page/emailpaper.html.twig',
                        array('enquiry' => $enquiry)
                    ),
                        'text/html'
                        );
                $mailer->send($message);




                return $this->redirectToRoute('success');
               return $this->redirect($this->generateUrl('contact'));
            }


        return $this->render('page/contact.html.twig', array(
            'form' => $form->createView()
        ));

    }


    public function sidebarAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $tags = $em->getRepository(blog::class)
            ->getTags();

        $tagWeights = $em->getRepository(blog::class)
            ->getTagWeights($tags);


        $latestComments = $em->getRepository(Comment::class)
            ->getLatestComments(10);

        return $this->render('page/sidebar.html.twig', array(
            'latestComments'    => $latestComments,
            'tags'              => $tagWeights
        ));



    }


    /**
     * @Route("/success", name="success")
     */
    public function successForm()
    {
        return $this->render("page/success_form.html.twig", ['title' => 'Успех!'] );
    }

}
