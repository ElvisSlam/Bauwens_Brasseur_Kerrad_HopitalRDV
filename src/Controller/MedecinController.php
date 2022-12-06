<?php

namespace App\Controller;

use App\Entity\Medecin;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

#[Route('/medecin')]
class MedecinController extends AbstractController
{
    #[Route('/', name: 'app_medecin')]
    public function index(): Response
    {
        return $this->render('medecin/index.html.twig', [
            'controller_name' => 'MedecinController',
        ]);
    }

    #[Route('/consultation', name: 'medecin_consultation_rdv')]
    public function medecinconsult(ManagerRegistry $doctrine, Request $request): Response
    {

        $repository=$doctrine->getRepository(Medecin::class);
        $lesMedecin=$repository->findAll();
            
        return $this->render('medecin/fonction/consultationrdv.html.twig', [
            'controller_name' => 'MedecinController',
            'lesMedecin' => $lesMedecin,
        ]);
    }
}
