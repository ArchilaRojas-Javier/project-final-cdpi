<?php

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\SecurityBundle\Security;


final class GoogleController extends AbstractController
{
   public function __construct(private Security $security){

   }

    #[Route('/connect/google', name: 'connect_google_start')]
    public function connectAction(ClientRegistry $clientRegistry): Response
    {
        $user = $this->security->getUser();
        
        if ($user) {
            
            return $this->redirectToRoute('app_dashboard');
        }
        return $clientRegistry
            ->getClient('google') 
            ->redirect(['openid', 'profile', 'email'],[]); 
    }

    #[Route('/connect/google/check', name: 'connect_google_check')]
    public function connectCheckAction(Request $request, ClientRegistry $clientRegistry): Response
    {
        $user = $this->security->getUser();

        if ($user) {
            
            return $this->redirectToRoute('app_dashboard');
        }
        return $this->redirectToRoute('app_login');
       
    }
}
