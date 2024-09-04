<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BurgerController extends AbstractController
{
    #[Route('/burgers', name: 'burger')]
    public function list(/*BurgerRepository $burgerRepository*/): Response
    {

     //   $burgers = burgerRepository->findAll();

        return $this->render('burgers_list.html.twig');
    }
}