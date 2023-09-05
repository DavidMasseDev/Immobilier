<?php

namespace App\Controller;

use App\Repository\EstateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'main_')]
class MainController extends AbstractController
{
    #[Route('', name: 'home')]
    public function list(EstateRepository $estateRepository): Response
    {
        $list = $estateRepository->findAll();
        return $this->render('main/home.html.twig', [
            "list" => $list,
        ]);
    }
}
