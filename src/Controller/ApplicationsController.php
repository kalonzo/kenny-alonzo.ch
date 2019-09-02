<?php

namespace App\Controller;

use App\Entity\Applications;
use App\Form\ApplicationsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/applications")
 */
class ApplicationsController extends AbstractController
{
    /**
     * @Route("/", name="applications_index", methods={"GET"})
     */
    public function index(): Response
    {
        $applications = $this->getDoctrine()
            ->getRepository(Applications::class)
            ->findAll();

        return $this->render('applications/index.html.twig', [
            'applications' => $applications,
        ]);
    }

    /**
     * @Route("/new", name="applications_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $application = new Applications();
        $form = $this->createForm(ApplicationsType::class, $application);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($application);
            $entityManager->flush();

            return $this->redirectToRoute('applications_index');
        }

        return $this->render('applications/new.html.twig', [
            'application' => $application,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idApp}", name="applications_show", methods={"GET"})
     */
    public function show(Applications $application): Response
    {
        return $this->render('applications/show.html.twig', [
            'application' => $application,
        ]);
    }

    /**
     * @Route("/{idApp}/edit", name="applications_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Applications $application): Response
    {
        $form = $this->createForm(ApplicationsType::class, $application);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('applications_index', [
                'idApp' => $application->getIdApp(),
            ]);
        }

        return $this->render('applications/edit.html.twig', [
            'application' => $application,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idApp}", name="applications_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Applications $application): Response
    {
        if ($this->isCsrfTokenValid('delete'.$application->getIdApp(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($application);
            $entityManager->flush();
        }

        return $this->redirectToRoute('applications_index');
    }
}
