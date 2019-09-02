<?php

namespace App\Controller;

use App\Entity\Websites;
use App\Form\WebsitesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/websites")
 */
class WebsitesController extends AbstractController
{
    /**
     * @Route("/", name="websites_index", methods={"GET"})
     */
    public function index(): Response
    {
        $websites = $this->getDoctrine()
            ->getRepository(Websites::class)
            ->findAll();

        return $this->render('websites/index.html.twig', [
            'websites' => $websites,
        ]);
    }

    /**
     * @Route("/new", name="websites_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $website = new Websites();
        $form = $this->createForm(WebsitesType::class, $website);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($website);
            $entityManager->flush();

            return $this->redirectToRoute('websites_index');
        }

        return $this->render('websites/new.html.twig', [
            'website' => $website,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idWeb}", name="websites_show", methods={"GET"})
     */
    public function show(Websites $website): Response
    {
        return $this->render('websites/show.html.twig', [
            'website' => $website,
        ]);
    }

    /**
     * @Route("/{idWeb}/edit", name="websites_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Websites $website): Response
    {
        $form = $this->createForm(WebsitesType::class, $website);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('websites_index', [
                'idWeb' => $website->getIdWeb(),
            ]);
        }

        return $this->render('websites/edit.html.twig', [
            'website' => $website,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idWeb}", name="websites_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Websites $website): Response
    {
        if ($this->isCsrfTokenValid('delete'.$website->getIdWeb(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($website);
            $entityManager->flush();
        }

        return $this->redirectToRoute('websites_index');
    }
}
