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


class RegisterController extends AbstractController
{
    /***
     * @Route("/register", name="register")
    
    public function index()
    {
        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
            'users' => $userRepository->findAll()
        ]);
    } ***/


     /**
     * @Route("/register", name="register", methods="GET|POST")
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder, \Swift_Mailer $mailer)
    {
        //create a user for our application is a litle bit more complexe to store to oune entities
        $formState = 0; // state form for controle for send to user 
        //to create our user we need to insert user => Gallerie (type userpicture) => cv inside portfolio
        //variable to stock id of suceful entity 

        $userId = Tools::genereteUUID();
        $galleryId = Tools::genereteUUID();
        $galleryIdType = 2;//Todo replace with constante in type entity user_cv = 2 
        $cvId = Tools::genereteUUID();
        $cvOrder = Tools::genereteUUID(); // order for cv => user can have many cv in her portfolio 
        $potId = Tools::genereteUUID(); // order for cv => user can have many cv in her portfolio 
        //Cv contain many depedance for commandite we defaulted the value
        //Todo Fill in function of work of candiate

        //entity for strucure of site need to be defaulted for commodity 
        //Portfolios dependence 
        $pictureType = $this->getDoctrine()->getRepository(Types::class)->find(Types::USER_PICTURE);
        $idContent = new Content();
        $idFooter = new Footer();
        $idHeader = new Header();
        $idMenuContent = new MenuContent();
        $idNavbar = new Navbar();

        $project = new Projects();
        $website = new Websites();

        switch ($formState) {
            case 0:
                // 1) build the form for all form you want handle 
                $user = new User();
                $form = $this->createForm(UserType::class, $user);
                // 2) handle the submiteds (input your logic form traitment)
                $form->handleRequest($request);
                    if ($form->isSubmitted() && $form->isValid()) {
                        //Todo recuperate variable if form is not valid with alert message to prevent retype of information
                        // 3) Encode the password (you could also do this via Doctrine listener)
                        $password = $passwordEncoder->encodePassword($user, $user->getPassword());
                        
                        $user->setPassword($password);
                        //4) Save current timestap for creation date
                        $date = new \DateTime('@'.strtotime('now'));//insert current timestamp
                        $user->setCreationDate($date);//assign date to current gallery object
                        $user->setLasLog($date);//assign date to current gallery object
                        $user->setId($userId);//assign date to current gallery object
                        // 5) save the User!
                        //var_dump($userId);
                        $emUser = $this->getDoctrine()->getManager();
                        $emUser->persist($user);
                        //$emUser->flush($user);

                    
                        // ... do any other work - like sending them an email, etc
                        // maybe set a "flash" success message for the user
                        $subject = 'Registration suceful';
                        $sender ='lab4tech-dev@lab4techdev';
                        $reciver = 'kalonzo@bluewin.ch';
                        $templateMail = 'emails/registration.html.twig';
                        $varTemplate = array ('name' => 'Kalonzo@bluewin.ch',);
                        $email = new EmailsController;
                        //$email->sendMail($subject, $sender, $reciver, $templateMail , $mailer, $varTemplate);         
                        // return $this->render('user/show.html.twig', ['user' => $user]);
                        $formState = 1;
                    }

                
               // break;
            case 1:
                $gallery = new Galleries();
                $formGal = $this->createForm(GalleriesType::class, $gallery);
        
                $formGal->handleRequest($request);
        
                if ($formGal->isSubmitted() && $formGal->isValid()) {
                    $emGal = $this->getDoctrine()->getManager();
        
                    //Insert File
                    // $file stores the uploaded PDF file
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                    $file = $gallery->getFilename();

                    $gallery->setIdGallery($galleryId);
                    $gallery->setIdType($pictureType);//Todo crate the condtante in User entity user_picture

                    $fileName = Tools::generateUniqueFileName().'.'.$file->guessExtension();
        
                    // Move the file to the directory where brochures are stored
                    try {
                        $file->move(
                            $this->getParameter('user_picture_directory'),
                            $fileName
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
 
                    $gallery->setUniquefilename($fileName);
                    $date = new \DateTime('@'.strtotime('now'));//insert current timestamp
                    $gallery->setCreationDate($date);//assign date to current gallery object
        
                    $emGal->persist($gallery);
                    $emGal->flush();
                    //var_dump($gallery);
                    //return $this->redirectToRoute('galleries_index');
                    $formState = 2;
                }
                
                //break;
            case 2:
                $cv = new Cv();
                $formCv = $this->createForm(CvType::class, $cv);
        
                $formCv->handleRequest($request);
                    //var_dump($request);
                if ($formCv->isSubmitted() && $formCv->isValid()) {
                    $emCv = $this->getDoctrine()->getManager();
                    $cv->setIdCv($cvId);
                    $emCv->persist($cv);
                    $formState = 3;
                }
                
                //break;
            case 3:
                $portfolio = new Portfolios();
                $formPort = $this->createForm(PortfoliosType::class, $portfolio);
        
                $formPort->handleRequest($request);
        
                if ($formPort->isSubmitted() && $formPort->isValid()) {
                    $emPort = $this->getDoctrine()->getManager();
                    $portfolio->setId($user);
                    $portfolio->setIdContent($idContent);
                    $portfolio->setIdFooter($idFooter);
                    $portfolio->setIdHeader($idHeader);
                    $portfolio->setIdMenuContent($idMenuContent);
                    $portfolio->setIdNavbar($idNavbar);

                    //insertion des liaison
                    $portfolio->addIdCv($cv);
                    $portfolio->addIdGallery($gallery);
                    $portfolio->addIdProject($project);
                    $portfolio->addIdWeb($website);
                    $emPort->persist($portfolio);
                    //return $this->redirectToRoute('portfolios_index');
                    $formState = 4;//state 4 represent end of procedure we can flush our user in database
                }
                               
                    var_dump($formState);
                break;
            case 4:
                die('Ready to flush all work');
                $emUser->flush(); //comment flush if you need to debug a specific function without polluating DB

                $emPort->flush();
                
                
                $emGal->flush();
                $gallery->addIdPortfolio($portfolio);
                $emCv->flush();
                
                //break;
        }

        return $this->render(
            'register/index.html.twig',
            array('form' => $form->createView()
                    ,'formGal' => $formGal->createView()
                    ,'formPort' => $formPort->createView()
                    ,'formCv' => $formCv->createView()
            )
        );
    }
}
