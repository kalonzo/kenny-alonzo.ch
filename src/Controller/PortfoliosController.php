<?php

namespace App\Controller;

use App\Entity\Portfolios;
use App\Form\PortfoliosType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Utils\Tools;

/**
 * @Route("/portfolios")
 */
class PortfoliosController extends AbstractController
{
    /**
     * @Route("/", name="portfolios_index", methods="GET")
     */
    public function index(): Response
    {
        $portfolios = $this->getDoctrine()
            ->getRepository(Portfolios::class)
            ->findAll();

        return $this->render('portfolios/index.html.twig', ['portfolios' => $portfolios]);
    }

    /**
     * @Route("/new", name="portfolios_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $portfolio = new Portfolios();
        $form = $this->createForm(PortfoliosType::class, $portfolio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            

            // 4) save the User!
            $date = new \DateTime('@'.strtotime('now'));//insert current timestamp
            $portfolio->setCreationDate($date);//assign date to current gallery object
            $portfolio->setIdPortfolio(Tools::genereteUUID());
            $portfolio->setId($this->getUser());//assign date to current gallery object
            // 5) save the User!
            //var_dump($userId);
            $emUser = $this->getDoctrine()->getManager();
            $emUser->persist($portfolio);
            $emUser->flush($portfolio);

            $em = $this->getDoctrine()->getManager();
            $em->persist($portfolio);
            $em->flush();

            return $this->redirectToRoute('portfolios_index');
        }

        return $this->render('portfolios/new.html.twig', [
            'portfolio' => $portfolio,
            'formPort' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idPortfolio}", name="portfolios_show", methods="GET")
     */
    public function show(Portfolios $portfolio): Response
    {
        return $this->render('portfolios/show.html.twig', ['portfolio' => $portfolio]);
    }

    /**
     * @Route("/{idPortfolio}/edit", name="portfolios_edit", methods="GET|POST")
     */
    public function edit(Request $request, Portfolios $portfolio): Response
    {
        $form = $this->createForm(PortfoliosType::class, $portfolio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('portfolios_index', ['idPortfolio' => $portfolio->getIdPortfolio()]);
        }

        return $this->render('portfolios/edit.html.twig', [
            'portfolio' => $portfolio,
            'formPort' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idPortfolio}", name="portfolios_delete", methods="DELETE")
     */
    public function delete(Request $request, Portfolios $portfolio): Response
    {
        if ($this->isCsrfTokenValid('delete'.$portfolio->getIdPortfolio(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($portfolio);
            $em->flush();
        }

        return $this->redirectToRoute('portfolios_index');
    }
}
