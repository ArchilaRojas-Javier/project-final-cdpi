<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\SearchBarType;
use App\Repository\SupplementRepository;

final class SearchBarController extends AbstractController
{
    #[Route('/search/bar', name: 'app_search_bar')]
    public function index(Request $request, SupplementRepository $supplementRepository): Response
    {
        $form = $this->createForm(SearchBarType::class);
        
        $form->handleRequest($request);

        $results = [];

        if ($form->isSubmitted() && $form->isValid()) {
            
            $query = $form->get('query')->getData();
            
            $results = $supplementRepository->searchByName($query);
            
            return $this->render('search_bar/result.html.twig', [
                'form' => $form->createView(),
                'results' => $results,
    
            ]);
        }

        return $this->render('search_bar/index.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
