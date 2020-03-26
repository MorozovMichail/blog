<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class PageController extends AbstractController
{
    /**
     * @Route("/", name="page")
     */
    public function indexAction()
    {
        return $this->render('page/index.html.twig');
    }
    /**
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
        return $this->render('page/about.html.twig');
         }

}
