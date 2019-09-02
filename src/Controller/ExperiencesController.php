<?php

namespace App\Controller;

use App\Entity\Experiences;
use App\Form\ExperiencesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/experiences")
 */
class ExperiencesController extends AbstractController
{
    /**
     * @Route("/", name="experiences_index", methods={"GET"})
     */
    public function index(): Response
    {
        $experiences = $this->getDoctrine()
            ->getRepository(Experiences::class)
            ->findAll();

        return $this->render('experiences/index.html.twig', [
            'experiences' => $experiences,
        ]);
    }

    /**
     * @Route("/new", name="experiences_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $experience = new Experiences();
        $form = $this->createForm(ExperiencesType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($experience);
            $entityManager->flush();

            return $this->redirectToRoute('experiences_index');
        }

        return $this->render('experiences/new.html.twig', [
            'experience' => $experience,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idExperience}", name="experiences_show", methods={"GET"})
     */
    public function show(Experiences $experience): Response
    {
        return $this->render('experiences/show.html.twig', [
            'experience' => $experience,
        ]);
    }

    /**
     * @Route("/{idExperience}/edit", name="experiences_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Experiences $experience): Response
    {
        $form = $this->createForm(ExperiencesType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('experiences_index', [
                'idExperience' => $experience->getIdExperience(),
            ]);
        }

        return $this->render('experiences/edit.html.twig', [
            'experience' => $experience,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idExperience}", name="experiences_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Experiences $experience): Response
    {
        if ($this->isCsrfTokenValid('delete'.$experience->getIdExperience(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($experience);
            $entityManager->flush();
        }

        return $this->redirectToRoute('experiences_index');
    }
}
