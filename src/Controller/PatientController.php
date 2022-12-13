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
use App\Form\RDVType;
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
        $user = $this->getUser();
        $lesPatients=$repository->findBy(array('patient' => $user));
        return $this->render('patient/consult/index.html.twig', [
            'controller_name' => 'Consultation RDV',
            'lesPatients' => $lesPatients,
        ]);
    }

    #[Route('/consult/{id}', name: 'patient_laconsul')]
    public function patientRdv(ManagerRegistry $doctrine, $id): Response
    {
        $repository=$doctrine->getRepository(RDV::class);
        $leRdv=$repository->find($id);
        return $this->render('patient/consult/detail.html.twig', [
            'controller_name' => 'Consultation RDV',
            'leRdv' => $leRdv,
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

    #[Route('/consult/modifier/{id}', name: 'app_modif_rdv', methods: ['GET', 'POST'])]
    public function edit(ManagerRegistry $doctrine,Request $request, $id): Response
    {
        $repository = $doctrine->getRepository(RDV::class);
        $em = $doctrine->getManager();
        $leRdv = $repository->find($id);
        $form = $this->createForm(RDVType::class, $leRdv);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $adherent = $form->getData();
            $em->persist($adherent);
            $em->flush();
            return $this->redirectToRoute('patient_consult');
        }
        return $this->render('patient/consult/modifier.html.twig', array(
            
            'leRdv' => $leRdv,
            'form' => $form->createView(),
        ));
    }

    
}
