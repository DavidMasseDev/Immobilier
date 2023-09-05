<?php

namespace App\Controller;

use App\Form\EstateType;
use App\Repository\EstateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/estate', name: 'estate_')]
class EstateController extends AbstractController
{
    #[Route('/{id}', name: 'show')]
    public function show(EstateRepository $estateRepository, Request $request, int $id): Response
    {
        $estate = $estateRepository->find($id);
        $estateForm = $this->createForm(EstateType::class, $estate);
        if(!$estate){
            throw $this->createNotFoundException("Oooops ! Not estate for this id");
        }
        return $this->render('estate/show.html.twig', [
            'estateForm' => $estateForm,
            'estate' => $estate
        ]);
    }
}
