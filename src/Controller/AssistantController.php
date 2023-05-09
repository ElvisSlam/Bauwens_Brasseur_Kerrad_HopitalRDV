<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Assistant;
use App\Entity\Statut;
use App\Entity\RDV;
use App\Form\DateRdvType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Extension\RoutingExtension;

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
    public function getLesRDVs(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(RDV::class);

        $rdvs = $repository->findBy(
            [],
            ['date' => 'DESC'],
        );

        $form = $this->createForm(DateRdvType::class);

        return $this->render('assistant/fonction/consultationrdv.html.twig', [
            'rdvs' => $rdvs,
            'form' => $form,
        ]);
    }

    #[Route('/assistant/validation', name: 'assistant_validation')]
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

    #[Route('/assistant/validation/{id}', name: 'validation_assistant')]
    public function validationRDVID(ManagerRegistry $doctrine, int $id): Response
    {

        $em = $doctrine->getManager();

        $repository = $doctrine->getRepository(RDV::class);
        $rdv = $repository->find($id);

        $repo = $doctrine->getRepository(Statut::class);
        $statut = $repo->find(2);

        $rdv->setStatut($statut);

        $em->persist($rdv);
        $em->flush();
        return $this->render('assistant/validation/valid.html.twig', [
            'controller_name' => 'AssistantController',
            'url' => 'assistant/',
            'rdvs' => $rdv,
        ]);
    }

    #[Route('/assistant/refus/{id}', name: 'refus_assistant')]
    public function refusRDV(ManagerRegistry $doctrine, int $id): Response
    {

        $em = $doctrine->getManager();

        $repository = $doctrine->getRepository(RDV::class);
        $rdv = $repository->find($id);

        $repo = $doctrine->getRepository(Statut::class);
        $statut = $repo->find(4);

        $rdv->setStatut($statut);

        $em->persist($rdv);
        $em->flush();
        return $this->render('assistant/validation/valid.html.twig', [
            'controller_name' => 'AssistantController',
            'url' => 'assistant/',
            'rdvs' => $rdv,
        ]);
    }
}
