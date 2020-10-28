<?php

namespace App\Controller;

use Spipu\Html2Pdf\Html2Pdf;

use App\Entity\Resiliation;
use App\Entity\Mandat;
use App\Form\ResiliationType;
use App\Repository\ResiliationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\KernelInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
/**
 * @Route("/resiliation")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class ResiliationController extends AbstractController
{
    /**
     * @Route("/", name="resiliation_index", methods={"GET"})
     */
    public function index(ResiliationRepository $resiliationRepository): Response
    {

        return $this->render('resiliation/index.html.twig', [
            'resiliations' => $resiliationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="resiliation_new", methods={"GET","POST"})
     */
    public function new(KernelInterface $kernel, Request $request, MailerInterface $mailer ): Response
    {
        $resiliation = new Resiliation();
        $mandat = new Mandat();
        $resiliation->setMandat($mandat);
        $resiliation->setStatus("Envoyée au client");
        $form = $this->createForm(ResiliationType::class, $resiliation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $resiliation = $form->getData();
            $mandat->setCreationDate(new \DateTime());
            $mandat->setIsSigned(false);
            $mandat->setResiliation($resiliation);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($resiliation);
            
            $mandat->setBroker($this->getUser());
            $entityManager->persist($mandat);
            $entityManager->flush();

            $link = $resiliation->getId();

            $email = (new TemplatedEmail())
            ->from('thomas@ria.com')
            ->to($mandat->getClient()->getEmail())
            ->subject('Signature électronique de votre mandat')
            ->htmlTemplate('emails/sign.html.twig')
            ->context([
                'link' => $link,
            ]);

            $mailer->send($email);
            
            return $this->redirectToRoute('resiliation_index');
        }

        return $this->render('resiliation/new.html.twig', [
            'resiliation' => $resiliation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="resiliation_show", methods={"GET"})
     */
    public function show(Resiliation $resiliation): Response
    {
        return $this->render('resiliation/show.html.twig', [
            'resiliation' => $resiliation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="resiliation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Resiliation $resiliation): Response
    {
        $form = $this->createForm(ResiliationType::class, $resiliation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('resiliation_index');
        }

        return $this->render('resiliation/edit.html.twig', [
            'resiliation' => $resiliation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="resiliation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Resiliation $resiliation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$resiliation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($resiliation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('resiliation_index');
    }
}
