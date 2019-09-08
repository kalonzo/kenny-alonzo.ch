<?php

namespace App\Controller;

//use for special request needing for user 
use App\Repository\UserRepository;
//use statement for form
use App\Form\PortfoliosType;
use App\Form\UserType;
use App\Form\GalleriesType;
use App\Form\CvType;
use App\Form\RegisterType;
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
//import personal class tools for business need
use App\Utils\Tools;
use Symfony\Component\Form\FormInterface;

/**
 * @Route("/register")
 */
class RegisterController extends AbstractController
{
    /**
     * @Route("/", name="register_index", methods="GET")
     */
    public function index(): Response
    {
        $portfolios = $this->getDoctrine()
            ->getRepository(Portfolios::class)
            ->findAll();

        return $this->render('register/index.html.twig', ['portfolios' => $portfolios]);
    }

    public function userPostAction(Request $request,FormInterface $form, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form for all form you want handle 
        $user = new User();
       
        // 2) handle the submiteds (input your logic form traitment)
        $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                //Todo recuperate variable if form is not valid with alert message to prevent retype of information
                // 3) Encode the password (you could also do this via Doctrine listener)
                $password = $passwordEncoder->encodePassword($user, $user->getPassword());
                $userId = Tools::genereteUUID();
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
                $emUser->flush($user);
                die();
                return $user;
      }
      return $form;
    }

    public function galleriyPostAction(Request $request)
    {
        //entity for strucure of site need to be defaulted for commodity 
        //Portfolios dependence 
        $pictureType = $this->getDoctrine()->getRepository(Types::class)->find(Types::USER_PICTURE);
        $galleryId = Tools::genereteUUID();
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
                $gallery->setIdType($pictureType);

                $fileName = Tools::generateUniqueFileName().'.'.$file->guessExtension();
            
                $gallery->setUniquefilename($fileName);
                $date = new \DateTime('@'.strtotime('now'));//insert current timestamp
                $gallery->setCreationDate($date);//assign date to current gallery object
                
                $emGal->persist($gallery);
                $emGal->flush();

            }
        
            return $formGal;
    }

    public function cvPostAction(Request $request)
    {
        
        $cv = new Cv();
        $cvId = Tools::genereteUUID();
        $formCv = $this->createForm(CvType::class, $cv);
        $formCv->handleRequest($request);

        if ($formCv->isSubmitted() && $formCv->isValid()) {

            $emCv = $this->getDoctrine()->getManager();
            $cv->setIdCv($cvId);
            $emCv->persist($cv);

        }
        
            return $formCv;
    }

    public function portfolioPostAction(Request $request){
        $idContent = new Content();
        $idFooter = new Footer();
        $idHeader = new Header();
        $idMenuContent = new MenuContent();
        $idNavbar = new Navbar();

        $project = new Projects();
        $website = new Websites();
        $portfolio = new Portfolios();
        $formPort = $this->createForm(PortfoliosType::class, $portfolio);
        $formPort->handleRequest($request);
        
            if ($formPort->isSubmitted() && $formPort->isValid()) {
                $emPort = $this->getDoctrine()->getManager();
                //$portfolio->setId($user);
                $portfolio->setIdContent($idContent);
                $portfolio->setIdFooter($idFooter);
                $portfolio->setIdHeader($idHeader);
                $portfolio->setIdMenuContent($idMenuContent);
                $portfolio->setIdNavbar($idNavbar);

                //insertion des liaison
               // $portfolio->addIdCv($cv);
               // $portfolio->addIdGallery($gallery);
                $portfolio->addIdProject($project);
                $portfolio->addIdWeb($website);
                $emPort->persist($portfolio);
                    
                //$emUser->flush(); //comment flush if you need to debug a specific function without polluating DB

                $emPort->flush();
            }
            return $formPort;
    }

    /**
     * @Route("/new", name="register_new", methods="GET|POST")
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder, \Swift_Mailer $mailer)
    {
        $portfolio = new Portfolios();
        $form = $this->createForm(RegisterType::class, $portfolio);

            

        $response = new Response();

        return $this->render(
            'register/new.html.twig',
            array(  'form' => $form->createView()
            )
        );
    }
}
