<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EmailsController extends AbstractController {

    /**
     * @Route("/sendmail", name="sendmail", methods="GET")
     */
    public function sendMail(\Swift_Mailer $mailer)
    {
        
        $subject = 'Registration suceful';
        $sender ='lab4tech-dev@lab4techdev';
        $reciver = 'kenalonjaq@gmail.com';
        $templateMail = 'emails/registration.html.twig';
        $varTemplate = array (
            'name' => 'Kalonzo@bluewin.ch',
        );
        
        $message = (new \Swift_Message($subject))
        ->setFrom($sender)
        ->setTo($reciver)
        ->setBody($this->renderView(
            $templateMail,
            $varTemplate
            ),
        'text/html'
        );
        $mailer->send($message);

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
}