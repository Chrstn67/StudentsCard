<?php

namespace App\Controller;

use App\Entity\Interro;
use App\Form\InterroType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InterroController extends AbstractController
{
    #[Route('/interro', name: 'app_interro', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $interros = $entityManager->getRepository(Interro::class)->findAll();

        return $this->render('interro/index.html.twig', [
            'interros' => $interros,
        ]);
    }

    #[Route('/interro/create', name: 'app_interro_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $interro = new Interro();
        $form = $this->createForm(InterroType::class, $interro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer la matière sélectionnée dans le formulaire
            $matiere = $form->get('matiere')->getData();

            // Assigner la matière à l'interro
            $interro->setMatiere($matiere);

            // Récupérer l'élève sélectionné dans le formulaire
            $eleve = $form->get('eleve')->getData();

            // Assigner l'élève à l'interro
            $interro->addEleve($eleve);

            $entityManager->persist($interro);
            $entityManager->flush();

            return $this->redirectToRoute('app_interro');
        }

        return $this->render('interro/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/interro/edit/{id}', name: 'app_interro_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager, Interro $interro): Response
    {
        $form = $this->createForm(InterroType::class, $interro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_interro');
        }

        return $this->render('interro/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/interro/delete/{id}', name: 'app_interro_delete', methods: ['POST'])]
    public function delete(Request $request, EntityManagerInterface $entityManager, Interro $interro): Response
    {
        $entityManager->remove($interro);
        $entityManager->flush();

        return $this->redirectToRoute('app_interro');
    }
}
