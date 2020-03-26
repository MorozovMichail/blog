<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NotAbController extends AbstractController
{
    /**
     * @Route("/not/ab", name="not_ab")
     */
    public function index()
    {
        return $this->render('not_ab/index.html.twig', [
            'controller_name' => 'NotAbController',
        ]);
    }
}
