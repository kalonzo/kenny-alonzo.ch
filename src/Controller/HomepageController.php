<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/homepage", name="homepage")
     */
    public function index(\Swift_Mailer $mailer)
    {
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(\Swift_Mailer $mailer)
    {
        return $this->render('homepage/contact.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about(\Swift_Mailer $mailer)
    {
        return $this->render('homepage/about.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }

}