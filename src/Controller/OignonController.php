<?php

namespace App\Controller;

use App\Entity\Oignon;
use App\Form\OignonType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OignonController extends AbstractController
{
    #[Route('/oignon', name: 'app_oignon')]
    public function index(): Response
    {
        return $this->render('oignon/index.html.twig', [
            'controller_name' => 'OignonController',
        ]);
    }

    #[Route('/oignon/add', name: 'oignon_new', methods: ['GET', 'POST'])]
public function new(Request $request, EntityManagerInterface $entityManager): Response
{
    $oignon = new Oignon();
    $form = $this->createForm(OignonType::class, $oignon);
 
    $form->handleRequest($request);
 
    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->persist($oignon);
        $entityManager->flush();
 
        return $this->redirectToRoute('oignon_new');
    }
 
    return $this->render('oignon_new.html.twig', [
        'form' => $form->createView(),
    ]);
}
}
