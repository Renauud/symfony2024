<?php

namespace App\Controller;

use App\Entity\Sauce;
use App\Form\SauceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SauceController extends AbstractController
{
    #[Route('/sauce', name: 'app_sauce')]
    public function index(): Response
    {
        return $this->render('sauce/index.html.twig', [
            'controller_name' => 'SauceController',
        ]);
    }

    #[Route('/sauce/add', name: 'sauce_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sauce = new Sauce();
        $form = $this->createForm(SauceType::class, $sauce);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sauce);
            $entityManager->flush();
    
            return $this->redirectToRoute('sauce_new');
        }
    
        return $this->render('sauce_new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
