<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClasseController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/classe', name: 'app_classe')]
    public function index(ClasseRepository $classeRepository): Response
    {
        $classes = $classeRepository->findBy([], ['nom' => 'ASC']);

        return $this->render('classe/index.html.twig', [
            'classes' => $classes,
        ]);
    }

    #[Route('/classe/create', name: 'app_classe_create')]
    public function create(Request $request): Response
    {
        $classe = new Classe();
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($classe);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_classe');
        }

        return $this->render('classe/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/classe/edit/{id}', name: 'app_classe_edit')]
    public function edit(Request $request, Classe $classe): Response
    {
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('app_classe');
        }

        return $this->render('classe/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/classe/delete/{id}', name: 'app_classe_delete')]
    public function delete(Request $request, Classe $classe): Response
    {
        $this->entityManager->remove($classe);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_classe');
    }
}
