<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Entity\Client;
use App\Entity\User;
use App\Repository\JobCategoryRepository;
use App\Repository\JobOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(JobOfferRepository $jobOfferRepository, JobCategoryRepository $jobCategoryRepository): Response
    {
        $jobOffer = $jobOfferRepository->findAllByLimit();
        $jobCategory = $jobCategoryRepository->findAll();
 
        if($this->getUser()){ 

            if($this->getUser()->getRoles()[0] === "ROLE_CANDIDATE"){
                $user = $this->getUser();
                $candidate= $this->getDoctrine()->getRepository(Candidate::class)->findOneBy(array('user' => $user->getId()));
        
                return $this->render('home/index.html.twig', [
                    'controller_name' => 'HomeController',
                    'user' => $user,
                    'candidate' => $candidate,
                    'job_category'=>$jobCategory,
                    'job_offers'=>$jobOffer,
                ]);

            }elseif($this->getUser()->getRoles()[0] === "ROLE_CLIENT") {

                $user = $this->getUser();
                $client= $this->getDoctrine()->getRepository(Client::class)->findOneBy(array('user' => $user->getId()));
        
                return $this->render('home/index.html.twig', [
                    'controller_name' => 'HomeController',
                    'user' => $user,
                    'client' => $client,
                    'job_category'=>$jobCategory,
                    'job_offers'=>$jobOffer,
                ]);

            }elseif($this->getUser()->getRoles()[0] == "ROLE_ADMIN"){

                $user = $this->getUser();
        
                return $this->render('home/index.html.twig', [
                    'controller_name' => 'HomeController',
                    'user' => $user,
                    'job_category'=>$jobCategory,
                    'job_offers'=>$jobOffer,
                ]);

            }
        }else{

            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
                'job_category'=>$jobCategory,
                    'job_offers'=>$jobOffer,
            ]);
        }
    }

    /**
     * @Route("/contactUs", priority=1, name="contactUs",  methods={"GET"})
     */
    public function contact(): Response
    {       
        if($user = $this->getUser()){
            
        $utilisateur= $this->getDoctrine()->getRepository(Candidate::class)->findOneBy(array('user' => $user->getId()));

        if(!$utilisateur){
            $utilisateur= $this->getDoctrine()->getRepository(Client::class)->findOneBy(array('user' => $user->getId()));
        }

        return $this->render('home/contactUs.html.twig', [
            'client' => $utilisateur,
            'candidate' => $utilisateur,
            'user' => $user,
          
        ]);
        }else{
            return $this->redirectToRoute('home');
        }
    }

     /**
     * @Route("/aboutUs", priority=1, name="aboutUs",  methods={"GET"})
     */
    public function about(): Response
{       if($user = $this->getUser()){
            
        $utilisateur= $this->getDoctrine()->getRepository(Candidate::class)->findOneBy(array('user' => $user->getId()));

        if(!$utilisateur){
            $utilisateur= $this->getDoctrine()->getRepository(Client::class)->findOneBy(array('user' => $user->getId()));
        }

        return $this->render('home/aboutUs.html.twig', [
            'client' => $utilisateur,
            'candidate' => $utilisateur,
            'user' => $user,
          
        ]);
      

    }else{
        return $this->redirectToRoute('home');
    }
}
}