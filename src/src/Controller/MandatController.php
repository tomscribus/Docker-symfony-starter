<?php

namespace App\Controller;

use App\Entity\Mandat;
use App\Form\MandatType;
use App\Repository\MandatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * @Route("/mandat")
 * @isGranted("IS_AUTHENTICATED_FULLY")
 */
class MandatController extends AbstractController
{
    /**
     * @Route("/", name="mandat_index", methods={"GET"})
     */
    public function index(MandatRepository $mandatRepository): Response
    {
        return $this->render('mandat/index.html.twig', [
            'mandats' => $mandatRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="mandat_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $mandat = new Mandat();
        $form = $this->createForm(MandatType::class, $mandat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $mandat->setCreationDate(new \DateTime());
            $mandat->setIsSigned(false);
            $entityManager->persist($mandat);
            $entityManager->flush();

            return $this->redirectToRoute('mandat_index');
        }

        return $this->render('mandat/new.html.twig', [
            'mandat' => $mandat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mandat_show", methods={"GET"})
     */
    public function show(Mandat $mandat): Response
    {
        return $this->render('mandat/show.html.twig', [
            'mandat' => $mandat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mandat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Mandat $mandat): Response
    {
        $form = $this->createForm(MandatType::class, $mandat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mandat_index');
        }

        return $this->render('mandat/edit.html.twig', [
            'mandat' => $mandat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mandat_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Mandat $mandat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mandat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mandat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mandat_index');
    }

    /**
     * @Route("/download/{filename}", name="mandat_download", methods={"GET"})
     */
    public function downloadAction(KernelInterface $kernel, $filename)
    {
        
        $path = $kernel->getProjectDir() . '/var/pdf/';
        $content = file_get_contents($path.$filename);

        $response = new Response();

        //set headers
        $response->headers->set('Content-Type', 'mime/type');
        $response->headers->set('Content-Disposition', 'attachment;filename="'.$filename);

        $response->setContent($content);
        return $response;
    }

    /**
     * @Route("/open/{filename}", name="mandat_open", methods={"GET"})
     */
    public function openAction(KernelInterface $kernel, $filename)
    {
        $path = $kernel->getProjectDir().'/var/pdf/'.$filename;

        return new BinaryFileResponse($path);
    }

}
