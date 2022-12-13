<?php

namespace App\Controller;

use App\Entity\RDV;
use App\Form\RDVType;
use App\Repository\RDVRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/rdv')]
class RDVController extends AbstractController
{
    #[Route('/', name: 'app_r_d_v_index', methods: ['GET'])]
    public function index(RDVRepository $rDVRepository): Response
    {
        return $this->render('rdv/index.html.twig', [
            'r_d_vs' => $rDVRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_r_d_v_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RDVRepository $rDVRepository): Response
    {
        $rDV = new RDV();
        $form = $this->createForm(RDVType::class, $rDV);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rDVRepository->save($rDV, true);

            return $this->redirectToRoute('app_r_d_v_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rdv/new.html.twig', [
            'r_d_v' => $rDV,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_r_d_v_show', methods: ['GET'])]
    public function show(RDV $rDV): Response
    {
        return $this->render('rdv/show.html.twig', [
            'r_d_v' => $rDV,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_rdv_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RDV $rDV, RDVRepository $rDVRepository): Response
    {
        $form = $this->createForm(RDVType::class, $rDV);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rDVRepository->save($rDV, true);

            return $this->redirectToRoute('app_r_d_v_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rdv/edit.html.twig', [
            'r_d_v' => $rDV,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_r_d_v_delete', methods: ['POST'])]
    public function delete(Request $request, RDV $rDV, RDVRepository $rDVRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rDV->getId(), $request->request->get('_token'))) {
            $rDVRepository->remove($rDV, true);
        }

        return $this->redirectToRoute('app_r_d_v_index', [], Response::HTTP_SEE_OTHER);
    }
}
