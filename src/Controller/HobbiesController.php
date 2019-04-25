<?php

namespace App\Controller;

use App\Entity\Hobbies;
use App\Form\HobbiesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/hobbies")
 */
class HobbiesController extends AbstractController
{
    /**
     * @Route("/", name="hobbies_index", methods={"GET"})
     */
    public function index(): Response
    {
        $hobbies = $this->getDoctrine()
            ->getRepository(Hobbies::class)
            ->findAll();

        return $this->render('hobbies/index.html.twig', [
            'hobbies' => $hobbies,
        ]);
    }

    /**
     * @Route("/new", name="hobbies_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $hobby = new Hobbies();
        $form = $this->createForm(HobbiesType::class, $hobby);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hobby);
            $entityManager->flush();

            return $this->redirectToRoute('hobbies_index');
        }

        return $this->render('hobbies/new.html.twig', [
            'hobby' => $hobby,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idHobbie}", name="hobbies_show", methods={"GET"})
     */
    public function show(Hobbies $hobby): Response
    {
        return $this->render('hobbies/show.html.twig', [
            'hobby' => $hobby,
        ]);
    }

    /**
     * @Route("/{idHobbie}/edit", name="hobbies_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Hobbies $hobby): Response
    {
        $form = $this->createForm(HobbiesType::class, $hobby);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hobbies_index', [
                'idHobbie' => $hobby->getIdHobbie(),
            ]);
        }

        return $this->render('hobbies/edit.html.twig', [
            'hobby' => $hobby,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idHobbie}", name="hobbies_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Hobbies $hobby): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hobby->getIdHobbie(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($hobby);
            $entityManager->flush();
        }

        return $this->redirectToRoute('hobbies_index');
    }
}
