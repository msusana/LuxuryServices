<?php

namespace App\Controller;

use App\Entity\InfoAdminClient;
use App\Form\InfoAdminClientType;
use App\Repository\ClientRepository;
use App\Repository\InfoAdminClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

/**
 * @Route("/info/admin/client")
 */
class InfoAdminClientController extends AbstractController
{
    /**
     * @Route("/", name="info_admin_client_index", methods={"GET"})
     */
    public function index(InfoAdminClientRepository $infoAdminClientRepository): Response
    {
        return $this->render('info_admin_client/index.html.twig', [
            'info_admin_clients' => $infoAdminClientRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="info_admin_client_new", methods={"GET","POST"})
     */
    public function new(Request $request, ClientRepository $clientRepository): Response
    {
        $infoAdminClient = new InfoAdminClient();
        $client = $clientRepository->findOneBy(['id'=> $request->get('id')]);
        if ($request->get('id') && $request->get('notes')) {
            $entityManager = $this->getDoctrine()->getManager();
            $infoAdminClient-> setNotes($request->get('notes'));
            $infoAdminClient-> setClient($client);
            $entityManager->persist($infoAdminClient);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('info_admin_candidate/new.html.twig', [
            'info_admin_client' => $infoAdminClient,
        ]);
    }

    /**
     * @Route("/{id}", name="info_admin_client_show", methods={"GET"})
     */
    public function show(InfoAdminClient $infoAdminClient): Response
    {
        return $this->render('info_admin_client/show.html.twig', [
            'info_admin_client' => $infoAdminClient,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="info_admin_client_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InfoAdminClient $infoAdminClient): Response
    {
        $form = $this->createForm(InfoAdminClientType::class, $infoAdminClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('info_admin_client_index');
        }

        return $this->render('info_admin_client/edit.html.twig', [
            'info_admin_client' => $infoAdminClient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="info_admin_client_delete", methods={"GET"})
     */
    public function delete(Request $request, InfoAdminClient $infoAdminClient): Response
    {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($infoAdminClient);
            $entityManager->flush();

        return $this->redirectToRoute('admin');
    }
}
