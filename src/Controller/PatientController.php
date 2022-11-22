<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function patientConsultRdv(): Response
    {
        return $this->render('patient/consult/index.html.twig', [
            'controller_name' => 'Consultation RDV',
        ]);
    }

    #[Route('/patient/demande', name: 'patient_demande')]
    public function patientDemandeRdv(): Response
    {
        return $this->render('patient/demande/index.html.twig', [
            'controller_name' => 'Demande RDV',
        ]);
    }
}
