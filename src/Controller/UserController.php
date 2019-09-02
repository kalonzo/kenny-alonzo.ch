<?php
namespace App\Controller;
//use for special request needing for user 
use App\Repository\UserRepository;
//use statement for form
use App\Form\GalleriesType;
use App\Form\PortfoliosType;
use App\Form\CvType;
use App\Form\UserType;
//use statement for entity nedeed handling by this controller
//user Controller
use App\Entity\User;
use App\Entity\Portfolios;
use App\Entity\Cv;
use App\Entity\Galleries;
use App\Entity\Types;
use App\Entity\Content;
use App\Entity\Footer;
use App\Entity\Header;
use App\Entity\MenuContent;
use App\Entity\Navbar;
use App\Entity\Projects;
use App\Entity\Websites;
//use statment for component
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;//need for passsword encryption
//Use statement for EmailsController for sending mail request 
use App\Controller\EmailsController;
// Includefor generate uuid
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
//import personal class tools for business need
use App\Utils\Tools;
use Symfony\Component\PropertyInfo\Type;
//para, convertot
/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods="GET")
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', ['users' => $userRepository->findAll()]);
    }
    /**
     * @Route("/new", name="user_new", methods="GET|POST")
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder, \Swift_Mailer $mailer)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            // 4) save the User!
            $date = new \DateTime('@'.strtotime('now'));//insert current timestamp
            $user->setCreationDate($date);//assign date to current gallery object
            $user->setLasLog($date);//assign date to current gallery object
            $user->setId(Tools::genereteUUID());//assign date to current gallery object
            // 5) save the User!
            //var_dump($userId);
            $emUser = $this->getDoctrine()->getManager();
            $emUser->persist($user);
            $emUser->flush($user);
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $subject = 'Registration suceful';
            $sender ='lab4tech-dev@lab4techdev';
            $reciver = 'kalonzo@bluewin.ch';
            $templateMail = 'emails/registration.html.twig';
            $varTemplate = array (
                'name' => 'Kalonzo@bluewin.ch',
            );
            $email = new EmailsController;
            //$email->sendMail($subject, $sender, $reciver, $templateMail , $mailer, $varTemplate);
            
            //die('Die in pieace');
            return $this->render('user/show.html.twig', ['user' => $user]);
        }
        return $this->render(
            'user/new.html.twig',
            array('form' => $form->createView())
        );
    }
    /**
     * @Route("/{id}", name="user_show", methods="GET")
     */
    public function show(User $user): Response
    {//Todo param convert
        return $this->render('user/show.html.twig', ['user' => $user]);
    }
    /**
     * @Route("/{id}/edit", name="user_edit", methods="GET|POST")
     */
    public function edit(Request $request, UserPasswordEncoderInterface $passwordEncoder, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPassword()); // +permet d'encoder le mot de passe envoyer en post
            $user->setPassword($password); // + stock la nouvelle valeur pour le mot de passe
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('user_edit', ['id' => $user->getId()]);
        }
        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="user_delete", methods="DELETE")
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }
        return $this->redirectToRoute('user_index');
    }
}