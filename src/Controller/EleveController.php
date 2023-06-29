<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Form\EleveType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EleveController extends AbstractController
{
    #[Route('/eleve', name: 'app_eleve')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sortBy = $request->query->get('sort');
        $orderBy = 'nom';

        if ($sortBy === 'classe') {
            $orderBy = 'classe';
        }

        $eleves = $entityManager->getRepository(Eleve::class)->findBy([], [$orderBy => 'ASC']);

        return $this->render('eleve/index.html.twig', [
            'eleves' => $eleves,
        ]);
    }


    #[Route('/eleve/create', name: 'app_eleve_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $eleve = new Eleve();
        $form = $this->createForm(EleveType::class, $eleve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($eleve);
            $entityManager->flush();

            return $this->redirectToRoute('app_eleve');
        }

        return $this->render('eleve/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/eleve/edit/{id}', name: 'app_eleve_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, Eleve $eleve): Response
    {
        $form = $this->createForm(EleveType::class, $eleve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_eleve');
        }

        return $this->render('eleve/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/eleve/delete/{id}', name: 'app_eleve_delete')]
    public function delete(Request $request, EntityManagerInterface $entityManager, Eleve $eleve): Response
    {
        $entityManager->remove($eleve);
        $entityManager->flush();

        return $this->redirectToRoute('app_eleve');
    }
}
