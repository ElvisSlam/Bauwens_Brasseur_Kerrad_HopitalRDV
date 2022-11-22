<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AssistantController extends AbstractController
{
    #[Route('/assistant', name: 'app_assistant')]
    public function index(): Response
    {
        return $this->render('assistant/index.html.twig', [
            'controller_name' => 'AssistantController',
        ]);
    }

    #[Route('/assistant/consultation', name: 'assistant_consultation_rdv')]
    public function medecinconsult(): Response
    {
        return $this->render('assistant/fonction/consultationrdv.html.twig', [
            'controller_name' => 'AssistantController',
        ]);
    }
}
