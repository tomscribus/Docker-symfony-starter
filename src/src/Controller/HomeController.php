<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function index()
    {
        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/clients", name="clients")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function clients()
    {
        return $this->render('home/clients.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
