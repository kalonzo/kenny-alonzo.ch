<?php

namespace App\Controller;

use App\Entity\Types;
use App\Form\TypesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/types")
 */
class TypesController extends AbstractController
{
    /**
     * @Route("/", name="types_index", methods="GET")
     */
    public function index(): Response
    {
        $types = $this->getDoctrine()
            ->getRepository(Types::class)
            ->findAll();

        return $this->render('types/index.html.twig', ['types' => $types]);
    }

    /**
     * @Route("/new", name="types_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $type = new Types();
        $form = $this->createForm(TypesType::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($type);
            $em->flush();

            return $this->redirectToRoute('types_index');
        }

        return $this->render('types/new.html.twig', [
            'type' => $type,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idType}", name="types_show", methods="GET")
     */
    public function show(Types $type): Response
    {
        return $this->render('types/show.html.twig', ['type' => $type]);
    }

    /**
     * @Route("/{idType}/edit", name="types_edit", methods="GET|POST")
     */
    public function edit(Request $request, Types $type): Response
    {
        $form = $this->createForm(TypesType::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('types_index', ['idType' => $type->getIdType()]);
        }

        return $this->render('types/edit.html.twig', [
            'type' => $type,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idType}", name="types_delete", methods="DELETE")
     */
    public function delete(Request $request, Types $type): Response
    {
        if ($this->isCsrfTokenValid('delete'.$type->getIdType(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($type);
            $em->flush();
        }

        return $this->redirectToRoute('types_index');
    }
}
