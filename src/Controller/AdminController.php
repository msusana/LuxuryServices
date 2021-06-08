<?php

namespace App\Controller;

use App\Entity\Candidacy;
use App\Entity\Candidate;
use App\Entity\Client;
use App\Entity\JobOffer;
use App\Controller\CandidacyController;
use App\Controller\JobOfferController;
use App\Repository\JobCategoryRepository;
use App\Repository\JobOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\InfoAdminCandidate;
use App\Controller\InfoAdminCandidateController;
use App\Form\InfoAdminCandidateType;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(Request $request, JobOfferRepository $jobOfferRepository, JobCategoryRepository $jobCategory): Response
    {
        $infoAdminCandidate = new InfoAdminCandidate();
        $formInfoCandidate = $this->createForm(InfoAdminCandidateType::class, $infoAdminCandidate);
        $formInfoCandidate->handleRequest($request);
      
        if($user = $this->getUser()){
            if(!$this->getUser()->getRoles()[0] == "ROLE_ADMIN"){
                $utilisateur= $this->getDoctrine()->getRepository(Candidate::class)->findOneBy(array('user' => $user->getId()));
    
            if(!$utilisateur){
                $utilisateur= $this->getDoctrine()->getRepository(Client::class)->findOneBy(array('user' => $user->getId()));
            }
                
    
            return $this->render('home/index.html.twig', [
                'controller_name' => 'AdminController',
                'client' => $utilisateur,
                'candidate' => $utilisateur,
                'job_offers' => $jobOfferRepository->findAllByLimit(),
                'job_category' => $jobCategory->findAll(),
                ]);
            }

            

            /******IF ADMIN  */
            $candidates= $this->getDoctrine()->getRepository(Candidate::class)->findAll();
            $clients= $this->getDoctrine()->getRepository(Client::class)->findAll();
            $candidacy= $this->getDoctrine()->getRepository(Candidacy::class)->findAll();
            $jobOffer= $this->getDoctrine()->getRepository(JobOffer::class)->findAll();

            $allInfos = ['candidates' => $candidates, 'clients' => $clients, 'candidacy' => $candidacy, 'jobOffer' => $jobOffer];

            return $this->render('admin/index.html.twig', [
                'controller_name' => 'AdminController',
                'admin_infos' => $allInfos,
                'formInfoCandidate' =>  $formInfoCandidate->createView(), 
                ]);
        }

    }
}
