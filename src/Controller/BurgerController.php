<?php

namespace App\Controller;

use App\Entity\Oignon;
use App\Entity\Pain;
use App\Entity\Sauce;
use App\Repository\BurgerRepository;
use App\Repository\OignonRepository;
use App\Repository\PainRepository;
use App\Repository\SauceRepository;
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

    if (!$ingredientType) {
        throw $this->createNotFoundException('Ingrédient non trouvé. Veuillez saisir un ingrédient valide!');
    }
        
    $burgers = $burgerRepository->findBurgerWithIngredient($ingredientType, $id);
    // $nomIng = $burgerRepository->getNameFromId($id);

        return $this->render('burger_search.html.twig',[
            'burgers' => $burgers,
            // 'nomIng' => $nomIng
        ]);
    }

    #[Route(path: '/burger/not/{id}', name: 'burger_search_exclude')]
    public function findBurgerWithoutIngredient(int $id, BurgerRepository $burgerRepository, SauceRepository $sauceRepository, OignonRepository $oignonRepository, PainRepository $painRepository){
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
    
        // if (!$ingredientType) {
        //     throw $this->createNotFoundException('Ingrédient non trouvé. Veuillez saisir un ingrédient valide!');
        // }
            
        $burgers = $burgerRepository->findBurgerWithoutIngredient($ingredientType, $id);
    
            return $this->render('burger_search_exclude.html.twig',[
                'burgers' => $burgers
            ]);
    }

    #[Route(path: '/burger/topexpensive/{number}', name: 'burger_expensive_list')]
    public function listTopXMostExpensiveBurger(int $number, BurgerRepository $burgerRepository){

        $burger_list = $burgerRepository->findTopXMostExpensiveBurger($number);
        // burger_qtty me sert pour l'affichage, si on renseigne un nombre plus important
        // que le nb de burger présent dans la bdd ça reviendra à afficher le nb max présent dans la bdd
        // ça évitera d'afficher "top 50 burgers" alors qu'il n'y en a en réalité que 47 etc etc, l'url ne se modifie cependant pas (pas encore?)
        $burger_qtty = Count($burger_list); 

        return $this->render('burger_expensive_list.html.twig', [
            'burgers' => $burger_list,
            'burger_qtty' => $burger_qtty
        ]);
    }
}