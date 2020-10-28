<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\NotificationRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function index(NotificationRepository $notificationRepository)
    {

        $notifications = $notificationRepository->findAll();
        return $this->render('notifications/notifications.html.twig', [
            'notifs' => $notifications,
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
