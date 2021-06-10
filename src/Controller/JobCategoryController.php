<?php

namespace App\Controller;

use App\Entity\JobCategory;
use App\Form\JobCategoryType;
use App\Repository\JobCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/job/category")
 */
class JobCategoryController extends AbstractController
{

    /**
     * @Route("/new", name="job_category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $jobCategory = new JobCategory();
        $form = $this->createForm(JobCategoryType::class, $jobCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($jobCategory);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('job_category/new.html.twig', [
            'job_category' => $jobCategory,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="job_category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, JobCategory $jobCategory): Response
    {
        $form = $this->createForm(JobCategoryType::class, $jobCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('job_category/edit.html.twig', [
            'job_category' => $jobCategory,
            'form' => $form->createView(),
        ]);
    }

}
