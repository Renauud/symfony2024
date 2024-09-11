<?php

namespace App\Controller;

use App\Repository\BurgerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BurgerController extends AbstractController
{

    #[Route('/burger/{id}', name: 'burger_details')]
    public function show(int $id){

        $listBurger = [
            1=>"burger1",
            2=>"burger2",
            3=>"burger3",
        ];

        $burger = $listBurger[$id];

        return $this->render('burger_detail.html.twig',
        [
            'id' => $id,
            'nomBurger' => $burger
        ]);
    }

    #[Route('/burgers', name: 'burger')]
    public function list(BurgerRepository $burgerRepository): Response
    {
        $listBurger = [
            1=>"burger1",
            2=>"burger2",
            3=>"burger3",
        ];

        //   $burgers = burgerRepository->findAll();

        return $this->render('burgers_list.html.twig',[
            'burgers' => $listBurger
        ]);
    }
}