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
            'url' => 'assistant/'
        ]);
    }

    #[Route('/assistant/validation', name: 'assistant_validation')]
    public function validationAssistant(): Response
    {
        return $this->render('assistant/validation/index.html.twig', [
            'controller_name' => 'Validation',
        ]);
    }
}
