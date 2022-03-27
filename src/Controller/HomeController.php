<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    //name: 'home'-> = a-> return new RedirectResponse($this->urlGenerator->generate('home')); di ...Authenticator.php
    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);

        //oppure:
        //return $this->redirectToRoute ('list_produit');
        //$this->getUser() mi da il loggato
    }
}
