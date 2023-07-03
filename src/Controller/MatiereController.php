<?php

namespace App\Controller;

use App\Entity\Matiere;
use App\Form\MatiereType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatiereController extends AbstractController
{
    #[Route('/matiere', name: 'app_matiere')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $matieres = $entityManager->getRepository(Matiere::class)->findBy([], ['nom' => 'ASC']);

        return $this->render('matiere/index.html.twig', [
            'matieres' => $matieres,
        ]);
    }

    #[Route('/matiere/create', name: 'app_matiere_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $matiere = new Matiere();
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($matiere);
            $entityManager->flush();

            return $this->redirectToRoute('app_matiere');
        }

        return $this->render('matiere/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/matiere/edit/{id}', name: 'app_matiere_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, Matiere $matiere): Response
    {
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_matiere');
        }

        return $this->render('matiere/edit.html.twig', [
            'form' => $form->createView(),
            'matiere' => $matiere,
        ]);
    }

    #[Route('/matiere/delete/{id}', name: 'app_matiere_delete', methods: ['DELETE'])]
    public function delete(Request $request, EntityManagerInterface $entityManager, Matiere $matiere): Response
    {
        if ($this->isCsrfTokenValid('delete' . $matiere->getId(), $request->request->get('_token'))) {
            $entityManager->remove($matiere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_matiere');
    }
}
