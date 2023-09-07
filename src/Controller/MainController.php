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
    public function list(EstateRepository $estateRepository, int $page = 1): Response
    {
        $countEstate = $estateRepository->count([]);
        $maxPage = ceil($countEstate/40);

        if($page < 1){
            $page = 1;
        }

        if($page <= $maxPage){
            $list = $estateRepository->findEstateWithPaginator($page);
        }else{
            throw$this->createNotFoundException('Page not found.');
        }

        return $this->render('main/home.html.twig', [
            "list" => $list,
            "currentPage" => $page,
            "maxPage" => $maxPage
        ]);
    }
}
