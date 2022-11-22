<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MedecinController extends AbstractController
{
    #[Route('/medecin', name: 'app_medecin')]
    public function index(): Response
    {
        return $this->render('medecin/index.html.twig', [
            'controller_name' => 'MedecinController',
        ]);
    }

    #[Route('/medecin/consultation', name: 'medecin_consultation_rdv')]
    public function medecinconsult(): Response
    {
        return $this->render('medecin/fonction/consultationrdv.html.twig', [
            'controller_name' => 'MedecinController',
        ]);
    }
}
