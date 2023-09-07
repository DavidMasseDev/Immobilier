<?php

namespace App\Controller;

use App\Entity\Estate;
use App\Form\EstateType;
use App\Repository\EstateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/estate', name: 'estate_')]
class EstateController extends AbstractController
{
    #[Route('/{id}', name: 'show')]
    public function show(EstateRepository $estateRepository, EntityManagerInterface $entityManager, Request $request, int $id): Response
    {
        $estate = $estateRepository->find($id);
        $estateForm = $this->createForm(EstateType::class, $estate);
        if (!$estate) {
            throw $this->createNotFoundException("Oooops ! Not estate for this id");
        }
        $estateForm->handleRequest($request);
        if ($estateForm->isSubmitted() && $estateForm->isValid()) {
            $entityManager->persist($estate);
            $entityManager->flush();
            $this->addFlash('success', 'Estate update.');
        }
        return $this->render('estate/show.html.twig', [
            'estateForm' => $estateForm,
            'estate' => $estate
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(EntityManagerInterface $em, Request $request):Response
    {
        $estate = new Estate();
        $estateForm = $this->createForm(EstateType::class, $estate);
        $estateForm->handleRequest($request);
        if($estateForm->isSubmitted() && $estateForm->isValid()){
            $estate->setCreatedAt(new \DateTime());

        }


    }

}
