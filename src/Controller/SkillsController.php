<?php

namespace App\Controller;

use App\Entity\Skills;
use App\Form\SkillsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/skills")
 */
class SkillsController extends AbstractController
{
    /**
     * @Route("/", name="skills_index", methods={"GET"})
     */
    public function index(): Response
    {
        $skills = $this->getDoctrine()
            ->getRepository(Skills::class)
            ->findAll();

        return $this->render('skills/index.html.twig', [
            'skills' => $skills,
        ]);
    }

    /**
     * @Route("/new", name="skills_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $skill = new Skills();
        $form = $this->createForm(SkillsType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($skill);
            $entityManager->flush();

            return $this->redirectToRoute('skills_index');
        }

        return $this->render('skills/new.html.twig', [
            'skill' => $skill,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idSkill}", name="skills_show", methods={"GET"})
     */
    public function show(Skills $skill): Response
    {
        return $this->render('skills/show.html.twig', [
            'skill' => $skill,
        ]);
    }

    /**
     * @Route("/{idSkill}/edit", name="skills_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Skills $skill): Response
    {
        $form = $this->createForm(SkillsType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('skills_index', [
                'idSkill' => $skill->getIdSkill(),
            ]);
        }

        return $this->render('skills/edit.html.twig', [
            'skill' => $skill,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idSkill}", name="skills_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Skills $skill): Response
    {
        if ($this->isCsrfTokenValid('delete'.$skill->getIdSkill(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($skill);
            $entityManager->flush();
        }

        return $this->redirectToRoute('skills_index');
    }
}