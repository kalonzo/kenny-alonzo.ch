<?php

namespace App\Controller;

use App\Entity\TypeCv;
use App\Form\TypeCvType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/cv")
 */
class TypeCvController extends AbstractController
{
    /**
     * @Route("/", name="type_cv_index", methods="GET")
     */
    public function index(): Response
    {
        $typeCvs = $this->getDoctrine()
            ->getRepository(TypeCv::class)
            ->findAll();

        return $this->render('type_cv/index.html.twig', ['type_cvs' => $typeCvs]);
    }

    /**
     * @Route("/new", name="type_cv_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $typeCv = new TypeCv();
        $form = $this->createForm(TypeCvType::class, $typeCv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeCv);
            $em->flush();

            return $this->redirectToRoute('type_cv_index');
        }

        return $this->render('type_cv/new.html.twig', [
            'type_cv' => $typeCv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idTypeCv}", name="type_cv_show", methods="GET")
     */
    public function show(TypeCv $typeCv): Response
    {
        return $this->render('type_cv/show.html.twig', ['type_cv' => $typeCv]);
    }

    /**
     * @Route("/{idTypeCv}/edit", name="type_cv_edit", methods="GET|POST")
     */
    public function edit(Request $request, TypeCv $typeCv): Response
    {
        $form = $this->createForm(TypeCvType::class, $typeCv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_cv_index', ['idTypeCv' => $typeCv->getIdTypeCv()]);
        }

        return $this->render('type_cv/edit.html.twig', [
            'type_cv' => $typeCv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idTypeCv}", name="type_cv_delete", methods="DELETE")
     */
    public function delete(Request $request, TypeCv $typeCv): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeCv->getIdTypeCv(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typeCv);
            $em->flush();
        }

        return $this->redirectToRoute('type_cv_index');
    }
}
