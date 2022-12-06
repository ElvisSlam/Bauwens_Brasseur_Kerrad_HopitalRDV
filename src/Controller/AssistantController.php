<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Assistant;
use App\Entity\RDV;
use Doctrine\Persistence\ManagerRegistry;

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

    #[Route('/assistant/consultation', name: 'assistant_consultation_rdv')]
    public function medecinconsult(): Response
    {
        return $this->render('assistant/fonction/consultationrdv.html.twig', [
            'controller_name' => 'AssistantController',
        ]);
    }

    #[Route('/assistant/consultation', name: 'assistant_consultation_rdv')]
    public function getLesAdherents(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Adherent::class);

        $RDVS = $repository->findAll();

        return $this->render('assistant/fonction/consultationrdv.html.twig', [
            'RDVS' => $RDVS,
        ]);
    }

    #[Route('/assistant/validation', name: 'app_assistant')]
    public function validationRDV(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(RDV::class);
        $rdvs = $repository->findAll();
        return $this->render('assistant/validation/index.html.twig', [
            'controller_name' => 'AssistantController',
            'url' => 'assistant/',
            'rdvs' => $rdvs,
        ]);
    }
}
