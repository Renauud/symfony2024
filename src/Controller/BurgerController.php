<?php

namespace App\Controller;

use App\Entity\Oignon;
use App\Entity\Pain;
use App\Entity\Sauce;
use App\Repository\BurgerRepository;
use App\Repository\OignonRepository;
use App\Repository\PainRepository;
use App\Repository\SauceRepository;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BurgerController extends AbstractController
{

    
    #[Route(path: '/burgers', name: 'burger')]
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

    // #[Route(path: '/burger/has/{sauce}', name: 'burger_search')]
    // public function findBurgerWithSauce(Sauce $sauce, BurgerRepository $burgerRepository){

    //     $ing = $burgerRepository->findBurgerWithSauce($sauce);

    //     return $this->render('burger_search.html.twig',[
    //         'burgers' => $ing
    //     ]);
    // }
    
    #[Route(path: '/burger/has/{id}', name: 'burger_search')]
    public function findBurgerWithIngredient(int $id, BurgerRepository $burgerRepository, SauceRepository $sauceRepository, OignonRepository $oignonRepository, PainRepository $painRepository){


    $ingredientType = null;
    $ingredient = null;

    $ingredient = $sauceRepository->find($id);
    if ($ingredient) {
        $ingredientType = 'sauce';
    }

    if (!$ingredient) {
        $ingredient = $oignonRepository->find($id);
        if ($ingredient) {
            $ingredientType = 'oignon';
        }
    }

    if (!$ingredient) {
        $ingredient = $painRepository->find($id);
        if ($ingredient) {
            $ingredientType = 'pain';
        }
    }
        
    $burgers = $burgerRepository->findBurgerWithIngredient($ingredientType, $id);

        return $this->render('burger_search.html.twig',[
            'burgers' => $burgers
        ]);
    }
}