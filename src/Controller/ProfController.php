<?php

namespace App\Controller;

use App\Entity\Prof;
use App\Form\ProfType;
use App\Repository\ProfRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfController extends AbstractController
{
    #[Route('/prof', name: 'app_prof')]
    public function index(ProfRepository $profRepository): Response
    {
        $profs = $profRepository->findBy([], ['nom_prof' => 'ASC']);

        return $this->render('prof/index.html.twig', [
            'profs' => $profs,
        ]);
    }

    #[Route('/prof/create', name: 'app_prof_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $prof = new Prof();
        $form = $this->createForm(ProfType::class, $prof);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($prof);
            $entityManager->flush();

            return $this->redirectToRoute('app_prof');
        }

        return $this->render('prof/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/prof/edit/{id}', name: 'app_prof_edit')]
    public function edit(Request $request, Prof $prof, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProfType::class, $prof);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_prof');
        }

        return $this->render('prof/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/prof/delete/{id}', name: 'app_prof_delete')]
    public function delete(Request $request, Prof $prof, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($prof);
        $entityManager->flush();

        return $this->redirectToRoute('app_prof');
    }
}