<?php

namespace App\Controller;

use App\Entity\Plane;
use App\Form\PlaneType;
use App\Repository\PlaneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/planes')]
class PlaneController extends AbstractController
{
    #[Route('/', name: 'app_plane_index', methods: ['GET'])]
    public function index(PlaneRepository $planeRepository): Response
    {
        return $this->render('plane/index.html.twig', [
            'planes' => $planeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_plane_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PlaneRepository $planeRepository): Response
    {
        $plane = new Plane();
        $form = $this->createForm(PlaneType::class, $plane);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $planeRepository->save($plane, true);

            return $this->redirectToRoute('app_plane_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plane/new.html.twig', [
            'plane' => $plane,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plane_show', methods: ['GET'])]
    public function show(Plane $plane): Response
    {
        return $this->render('plane/show.html.twig', [
            'plane' => $plane,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_plane_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Plane $plane, PlaneRepository $planeRepository): Response
    {
        $form = $this->createForm(PlaneType::class, $plane);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $planeRepository->save($plane, true);

            return $this->redirectToRoute('app_plane_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plane/edit.html.twig', [
            'plane' => $plane,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plane_delete', methods: ['POST'])]
    public function delete(Request $request, Plane $plane, PlaneRepository $planeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plane->getId(), $request->request->get('_token'))) {
            $planeRepository->remove($plane, true);
        }

        return $this->redirectToRoute('app_plane_index', [], Response::HTTP_SEE_OTHER);
    }
}
