<?php

namespace App\EventSubscriber;

use App\Entity\Notification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use App\Event\ClientSignEvent;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpKernel\KernelInterface;

class NotificationSubscriber implements EventSubscriberInterface

{
    
    private $em;
    
    public function __construct(EntityManagerInterface $em, MailerInterface $mailer, KernelInterface $kernel )

    {
        $this->em = $em;
        $this->mailer = $mailer;
        $this->kernel = $kernel;
    }


    public function onClientSign(ClientSignEvent $event)
    {
       $notification = new Notification();

       $notification
       ->setTitle($event->getTitle())
       ->setMessage($event->getMessage());

       $this->em->persist($notification);
       $this->em->flush();

       $path = $this->kernel->getProjectDir().'/var/pdf/resiliation_15.pdf';
       
       $email = (new Email())
            ->from('thomas@ria.com')
            ->to('thom.schreiber@gmail.com')
            ->subject('Signature électronique de votre mandat')
            ->html('Un client à signé son mandat')
            ->attachFromPath($path);

        $this->mailer->send($email);
    }

    public static function getSubscribedEvents()
    {
        return [
            'client.signed' => 'onClientSign',
        ];
    }
}
