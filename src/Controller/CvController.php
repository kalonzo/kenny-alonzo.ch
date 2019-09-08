<?php

namespace App\Controller;

use App\Entity\Cv;
use App\Form\CvType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Utils\Tools;
use App\Entity\Portfolios;

/**
 * @Route("/cv")
 */
class CvController extends AbstractController
{
    /**
     * @Route("/", name="cv_index", methods="GET")
     */
    public function index(): Response
    {
        $cvs = $this->getDoctrine()
            ->getRepository(Cv::class)
            ->findAll();

        return $this->render('cv/index.html.twig', ['cvs' => $cvs]);
    }

    /**
     * @Route("/new", name="cv_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $cv = new Cv();
        $form = $this->createForm(CvType::class, $cv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $date = new \DateTime('@'.strtotime('now'));//insert current timestamp
            $cv->setCreationDate($date);//assign date to current gallery object
            $cv->setIdCv(Tools::genereteUUID());

            //register path
            $user = $this->getUser();
            if(isset($user)){
                // from inside a controller
                $repository = $this->getDoctrine()->getRepository(Portfolios::class);

                //$idPortfolio = $repository->find($id);
                $idPortfolio = $repository->findOneBy(['id' => $this->getUser()->getId()]);

                $cv->addIdPortfolio($idPortfolio);
            }
            


            $em = $this->getDoctrine()->getManager();
            $em->persist($cv);
            $em->flush();

            return $this->redirectToRoute('cv_index');
        }

        return $this->render('cv/new.html.twig', [
            'cv' => $cv,
            'formCv' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idCv}", name="cv_show", methods="GET")
     */
    public function show(Cv $cv): Response
    {
        return $this->render('cv/show.html.twig', ['cv' => $cv]);
    }

    /**
     * @Route("/{idCv}/edit", name="cv_edit", methods="GET|POST")
     */
    public function edit(Request $request, Cv $cv): Response
    {
        $form = $this->createForm(CvType::class, $cv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cv_index', ['idCv' => $cv->getIdCv()]);
        }

        return $this->render('cv/edit.html.twig', [
            'cv' => $cv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idCv}", name="cv_delete", methods="DELETE")
     */
    public function delete(Request $request, Cv $cv): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cv->getIdCv(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cv);
            $em->flush();
        }

        return $this->redirectToRoute('cv_index');
    }
}
