<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Patient;
use App\Entity\RDV;
use App\Entity\Statut;
use App\Form\DemandeRDVType;
use Symfony\Component\HttpFoundation\Request;

#[Route('/patient')]
class PatientController extends AbstractController
{
    #[Route('/', name: 'app_patient')]
    public function index(): Response
    {
        return $this->render('patient/index.html.twig', [
            'controller_name' => 'PatientController',
            'url' => 'patient/',
        ]);
    }

    #[Route('/consult', name: 'patient_consult')]
    public function patientConsultRdv(ManagerRegistry $doctrine): Response
    {
        $repository=$doctrine->getRepository(RDV::class);
        $lesPatients=$repository->findAll();
        return $this->render('patient/consult/index.html.twig', [
            'controller_name' => 'Consultation RDV',
            'lesPatients' => $lesPatients,
        ]);
    }

    #[Route('/demande', name: 'patient_demande')]
    public function patientDemandeRdv(ManagerRegistry $doctrine, Request $request): Response
    {
        $repository=$doctrine->getRepository(Statut::class);
        $statut=$repository->find(1);
        $em = $doctrine->getManager();
        $laConsul = new RDV;
        $laConsul->setPatient($this->getUser());
        $laConsul->setStatut($statut);
        $form = $this->createForm(DemandeRDVType::class, $laConsul);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $laConsul = $form->getData();
            $em->persist($laConsul);
            $em->flush();
            return $this->redirectToRoute('app_patient');
        }

        return $this->render('patient/demande/index.html.twig', [
            'controller_name' => 'Demande RDV',
            'form' => $form->createView(),
        ]);
    }

    
}
