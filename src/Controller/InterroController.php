<?php

namespace App\Controller;

use App\Entity\Interro;
use App\Form\InterroType;
use App\Repository\InterroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InterroController extends AbstractController
{
    #[Route('/interro', name: 'app_interro', methods: ['GET'])]
    public function index(InterroRepository $interroRepository): Response
    {
        $interros = $interroRepository->findAll();

        return $this->render('interro/index.html.twig', [
            'interros' => $interros,
        ]);
    }

    #[Route('/interro/create', name: 'app_interro_create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $interro = new Interro();
        $form = $this->createForm(InterroType::class, $interro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($interro);
            $entityManager->flush();

            return $this->redirectToRoute('app_interro');
        }

        return $this->render('interro/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/interro/edit/{id}', name: 'app_interro_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Interro $interro): Response
    {
        $form = $this->createForm(InterroType::class, $interro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_interro_index');
        }

        return $this->render('interro/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/interro/delete/{id}', name: 'app_interro_delete', methods: ['POST'])]
    public function delete(Request $request, Interro $interro): Response
    {
        if ($this->isCsrfTokenValid('delete' . $interro->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($interro);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_interro_index');
    }
}
