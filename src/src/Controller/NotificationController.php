<?php

namespace App\Controller;

use App\Repository\NotificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends AbstractController
{
     /**
     * @Route("api/notification", name="api_notification_index", methods={"GET"})
     */
    public function api_index(NotificationRepository $notificationRepository)
    {
        return $this->json($notificationRepository->findAll(), 200, [], ['groups' => 'show_notification']);
    }
}
