<?php

namespace App\Controller;

use App\Entity\Greenhouse;
use App\Form\GreenhouseType;
use App\Repository\GreenhouseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/greenhouse')]
class GreenhouseController extends AbstractController
{
    #[Route('/', name: 'app_greenhouse_index', methods: ['GET'])]
    public function index(GreenhouseRepository $greenhouseRepository): Response
    {
        return $this->render('greenhouse/index.html.twig', [
            'greenhouses' => $greenhouseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_greenhouse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GreenhouseRepository $greenhouseRepository): Response
    {
        $greenhouse = new Greenhouse();
        $form = $this->createForm(GreenhouseType::class, $greenhouse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $greenhouseRepository->save($greenhouse, true);

            return $this->redirectToRoute('app_greenhouse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('greenhouse/new.html.twig', [
            'greenhouse' => $greenhouse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_greenhouse_show', methods: ['GET'])]
    public function show(Greenhouse $greenhouse): Response
    {
        return $this->render('greenhouse/show.html.twig', [
            'greenhouse' => $greenhouse,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_greenhouse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Greenhouse $greenhouse, GreenhouseRepository $greenhouseRepository): Response
    {
        $form = $this->createForm(GreenhouseType::class, $greenhouse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $greenhouseRepository->save($greenhouse, true);

            return $this->redirectToRoute('app_greenhouse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('greenhouse/edit.html.twig', [
            'greenhouse' => $greenhouse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_greenhouse_delete', methods: ['POST'])]
    public function delete(Request $request, Greenhouse $greenhouse, GreenhouseRepository $greenhouseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$greenhouse->getId(), $request->request->get('_token'))) {
            $greenhouseRepository->remove($greenhouse, true);
        }

        return $this->redirectToRoute('app_greenhouse_index', [], Response::HTTP_SEE_OTHER);
    }
}
