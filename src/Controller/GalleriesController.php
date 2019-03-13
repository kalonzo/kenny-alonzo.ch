<?php

namespace App\Controller;

use App\Entity\Galleries;
use App\Form\GalleriesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Utils\Tools;

/**
 * @Route("/galleries")
 */
class GalleriesController extends AbstractController
{
    /**
     * @Route("/", name="galleries_index", methods="GET")
     */
    public function index(): Response
    {
        $galleries = $this->getDoctrine()
            ->getRepository(Galleries::class)
            ->findAll();

        return $this->render('galleries/index.html.twig', ['galleries' => $galleries]);
    }

    /**
     * @Route("/new", name="galleries_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $gallery = new Galleries();
        $form = $this->createForm(GalleriesType::class, $gallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

             //Insert File
             // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $gallery->getFilename();

            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $file->move(
                    $this->getParameter('user_picture_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $gallery->setUniquefilename(getTimeZone());
            $date = new \DateTime('@'.strtotime('now'));//insert current timestamp
            $gallery->setCreationDate($date);//assign date to current gallery object

            $em->persist($gallery);
            $em->flush();

            return $this->redirectToRoute('galleries_index');
        }

        return $this->render('galleries/new.html.twig', [
            'gallery' => $gallery,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idGallery}", name="galleries_show", methods="GET")
     */
    public function show(Galleries $gallery): Response
    {
        return $this->render('galleries/show.html.twig', ['gallery' => $gallery]);
    }

    /**
     * @Route("/{idGallery}/edit", name="galleries_edit", methods="GET|POST")
     */
    public function edit(Request $request, Galleries $gallery): Response
    {
        $form = $this->createForm(GalleriesType::class, $gallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('galleries_index', ['idGallery' => $gallery->getIdGallery()]);
        }

        return $this->render('galleries/edit.html.twig', [
            'gallery' => $gallery,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idGallery}", name="galleries_delete", methods="DELETE")
     */
    public function delete(Request $request, Galleries $gallery): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gallery->getIdGallery(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($gallery);
            $em->flush();
        }

        return $this->redirectToRoute('galleries_index');
    }
}
