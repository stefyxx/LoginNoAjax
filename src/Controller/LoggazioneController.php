<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoggazioneController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        //if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }
        
            //$authenticationUtils memorissa SIA chi si é loggato(come la _SESSION) che gli ERRORI
            //quando scrivo localhost:8000/login, entro in questa azione, ma $lastUsername E' VUOTO ANCORA, quindi memorizzo un errore
            //e lancio la View 'security/login.html.twig' (entra nella View)

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    //se vuoi, puoi utilizzare la route verso un altro controller modofocando direttamente
    //confog -> packages -> security.yaml : linea 27: # target: app_any_route ->target:'home'
    // 'home' é il  path di Route
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): Response
    {
        //throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
        return $this->redirectToRoute('/home');
    }
}
