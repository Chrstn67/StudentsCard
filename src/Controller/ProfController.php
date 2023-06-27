<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfController extends AbstractController
{
    #[Route('/prof', name: 'app_prof')]
    public function index(): Response
    {
        return $this->render('prof/index.html.twig', [
            'controller_name' => 'ProfController',
        ]);
    }
}
