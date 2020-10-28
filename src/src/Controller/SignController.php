<?php

namespace App\Controller;

use App\Entity\Resiliation;
use App\Entity\Mandat;
use Spipu\Html2Pdf\Html2Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpKernel\KernelInterface;
use App\Form\ResiliationType;
use App\Event\ClientSignEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class SignController extends AbstractController
{
    /**
     * @Route("/sign/{id}", name="mandat_sign", methods={"GET","POST"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function edit(Request $request, KernelInterface $kernel, Resiliation $resiliation, EventDispatcherInterface $dispatcher): Response
    {

        $form = $this->createForm(ResiliationType::class, $resiliation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $client = $resiliation->getMandat()->getClient();
           
            $html2pdf = new Html2Pdf('P', 'A4', 'fr');
            $certificate = 'file://'.dirname(__DIR__, 2).'/tcpdf.crt';
                
            $html = $this->renderView('resiliation/pdf.html.twig', [
                'client' => $client,
                'resiliation' => $resiliation,
            ]);

            $filesDirectory = $kernel->getProjectDir() . '/var/pdf/';
            $fileName = 'resiliation_'.$resiliation->getId(). '.pdf';
            
            $pdfFilepath =  $filesDirectory . $fileName;

            $html2pdf->pdf->setSignature($certificate, $certificate, '', '', 2 );

            
            $output = $html2pdf->writeHtml($html)->output($pdfFilepath, 'F');

            $mandat = $resiliation->getMandat();
            $mandat->setDocument($fileName);
            $resiliation->setStatus("Signée par le client");
            $this->getDoctrine()->getManager()->flush();

            $event = new ClientSignEvent($mandat->getClient(), "un nouveau document viens d'etre signé");
            $dispatcher->dispatch($event, ClientSignEvent::NAME);

            return $this->redirectToRoute('resiliation_index');
        }

        return $this->render('resiliation/edit.html.twig', [
            'resiliation' => $resiliation,
            'form' => $form->createView(),
        ]);
    }
}
