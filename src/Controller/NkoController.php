<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NkoController extends AbstractController
{
    /**
     * @Route("/", name="nko_list")
     */
    public function index()
    {
        return $this->render('nko/index.html.twig', [
            'controller_name' => 'NkoController',
        ]);
    }
}
