<?php

namespace App\Controller;

use App\Entity\Burger;
use App\Entity\Oignon;
use App\Entity\Pain;
use App\Entity\Sauce;
use App\Form\BurgerType;
use App\Repository\BurgerRepository;
use App\Repository\OignonRepository;
use App\Repository\PainRepository;
use App\Repository\SauceRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route(path: '/burger/has/{ingredientType}/{id}', name: 'burger_search')]
    public function findBurgerWithIngredient(string $ingredientType, int $id, EntityManagerInterface $entityManager, BurgerRepository $burgerRepository){

        $ingRepo = $this->getOneIngredientRepo($ingredientType, $entityManager);

        $ingredient = $ingRepo->findOneBy(["id" => $id]);

        $ingNom = $ingredient->getNom();

        if (!$ingredientType) {
            throw $this->createNotFoundException('Ingrédient non trouvé. Veuillez saisir un ingrédient valide!');
        }

        $burgers = $burgerRepository->findBurgerWithIngredient($ingredient);
        
        return $this->render('burger_search.html.twig',[
            'burgers' => $burgers,
            'ingredientType' => $ingredientType,
            'ingNom' =>$ingNom
        ]);
    }

    #[Route(path: '/burger/not/{ingredientType}/{id}', name: 'burger_search_exclude')]
    public function findBurgerWithoutIngredient(string $ingredientType, int $id, BurgerRepository $burgerRepository, SauceRepository $sauceRepository, OignonRepository $oignonRepository, PainRepository $painRepository){
    
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

    #[Route(path: '/burger/min/{minNumber}', name: 'burger_min_ingredients')]
    public function findBurgersWithMinimumIngredients(int $minNumber, BurgerRepository $burgerRepository, EntityManagerInterface $entityManager){


        $burgers = $burgerRepository->findBurgersWithMinimumIngredients($minNumber);

        return $this->render('burger_min_ingredients.html.twig', [
            'burgers' => $burgers,
            'numMin' => $minNumber
        ]);

    }


    #[Route('/burger/add/burger', name:"ajout_burger", methods: ['GET', "POST"])]
    public function creation(Request $request, EntityManagerInterface $em): Response{

        $burger = new Burger();
        $form = $this->createForm(BurgerType::class, $burger);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($burger);
            $em->flush();

            $this->addFlash('success', 'Burger créé !');
            return $this->redirectToRoute('burger_details');
        }

        return $this->render('ajout_burger.html.twig',[
            'form' => $form
        ]);
    }

    public function getOneIngredientRepo(string $ingredientType, EntityManagerInterface $entityManager): object{

        switch($ingredientType){
            case "sauce":
                $ingRepo = $entityManager->getRepository(Sauce::class);
                break;
            case "oignon":
                $ingRepo = $entityManager->getRepository(Oignon::class);
                break;
            case "pain": 
                $ingRepo = $entityManager->getRepository(Pain::class);
                break;   
        }

        return $ingRepo;

    }
}