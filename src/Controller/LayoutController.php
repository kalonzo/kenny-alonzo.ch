<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Portfolios;
use App\Entity\Projects;
use App\Entity\Tasks;

class LayoutController extends AbstractController
{
    /**
     * @Route("/layout", name="layout")
     */
    public function index()
    {
        return $this->render('layout/index.html.twig', [
            'controller_name' => 'LayoutController',
        ]);
    }


    public function headerAction()
    { 
        $user = $this->getUser();
        if($user){
            $portfolio = $this->getDoctrine()
            ->getRepository(Portfolios::class)
            ->find($user);

            if($portfolio){
                //
                $em = $this->getDoctrine()->getManager();
                $projects = $em->getRepository(Projects::class)->findAll($portfolio);
                if(null === $projects){
                    //Tod Proced some template logic
                    die("LayoutController 41 no project in portfolio");
                }else{
                    $tasks = $em->getRepository(Tasks::class)->findAll($projects);
                    if(null === $tasks){
                        //Tod Proced some template logic
                        die("LayoutController 45 no tasks in project");
                    }else{
                        //single view for basic header
                        return $this->render('layout/header.html.twig', [
                            'user' => $user,
                            'portfolio' => $portfolio,
                            'projects' => $projects,
                            'tasks' => $tasks,
                        ]);
                    }
                }
            }else{
                //proced Portfolio creation
                //echo("LayoutController 52 no portfolio for user ");
                return $this->render('layout/header.html.twig', [
                    'user' => $user,
                    'portfolio' => 'portfolio',
                    'projects' => 'projects',
                    'tasks' => 'tasks',
                ]);
            }
        }else{
            //No detected User proced to template or / and user login/registration
            return $this->render('layout/header.html.twig');
        }
    }
 
    public function footerAction()
    {

        
        return $this->render('layout/footer.html.twig');
    }
}
