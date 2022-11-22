<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Patient;
use App\Entity\Statut;

class PatientController extends AbstractController
{
    #[Route('/patient', name: 'app_patient')]
    public function index(): Response
    {
        return $this->render('patient/index.html.twig', [
            'controller_name' => 'PatientController',
            'url' => 'patient/',
        ]);
    }

    #[Route('/patient/consult', name: 'patient_consult')]
    public function patientConsultRdv(ManagerRegistry $doctrine): Response
    {
        $repository=$doctrine->getRepository(Patient::class);
        $lesPatients=$repository->findAll();
        return $this->render('patient/consult/index.html.twig', [
            'controller_name' => 'Consultation RDV',
            'lesPatients' => $lesPatients,
        ]);
    }

    #[Route('/patient/demande', name: 'patient_demande')]
    public function patientDemandeRdv(ManagerRegistry $doctrine): Response
    {
        return $this->render('patient/demande/index.html.twig', [
            'controller_name' => 'Demande RDV',
        ]);
    }
}
