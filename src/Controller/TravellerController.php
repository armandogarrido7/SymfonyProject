<?php

namespace App\Controller;

use App\Entity\Traveller;
use App\Form\TravellerType;
use App\Repository\TravellerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/travellers')]
class TravellerController extends AbstractController
{
    #[Route('/', name: 'app_traveller_index', methods: ['GET'])]
    public function index(TravellerRepository $travellerRepository): Response
    {
        return $this->render('traveller/index.html.twig', [
            'travellers' => $travellerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_traveller_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TravellerRepository $travellerRepository): Response
    {
        $traveller = new Traveller();
        $form = $this->createForm(TravellerType::class, $traveller);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $travellerRepository->save($traveller, true);

            return $this->redirectToRoute('app_traveller_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('traveller/new.html.twig', [
            'traveller' => $traveller,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_traveller_show', methods: ['GET'])]
    public function show(Traveller $traveller): Response
    {
        return $this->render('traveller/show.html.twig', [
            'traveller' => $traveller,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_traveller_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Traveller $traveller, TravellerRepository $travellerRepository): Response
    {
        $form = $this->createForm(TravellerType::class, $traveller);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $travellerRepository->save($traveller, true);

            return $this->redirectToRoute('app_traveller_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('traveller/edit.html.twig', [
            'traveller' => $traveller,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_traveller_delete', methods: ['POST'])]
    public function delete(Request $request, Traveller $traveller, TravellerRepository $travellerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$traveller->getId(), $request->request->get('_token'))) {
            $travellerRepository->remove($traveller, true);
        }

        return $this->redirectToRoute('app_traveller_index', [], Response::HTTP_SEE_OTHER);
    }
}
