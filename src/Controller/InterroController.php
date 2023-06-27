<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InterroController extends AbstractController
{
    #[Route('/interro', name: 'app_interro')]
    public function index(): Response
    {
        return $this->render('interro/index.html.twig', [
            'controller_name' => 'InterroController',
        ]);
    }
}
