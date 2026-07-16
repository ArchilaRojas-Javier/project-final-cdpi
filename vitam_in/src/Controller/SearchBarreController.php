<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\SearchBarreType;
use App\Repository\SupplementRepository;

final class SearchBarreController extends AbstractController
{
    #[Route('/search/barre', name: 'app_search_barre')]
    public function index(Request $request, SupplementRepository $supplementRepository): Response
    {
        $form = $this->createForm(SearchBarreType::class);
        
        $form->handleRequest($request);

        $results = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $query = $form->get('query')->getData();
            // Llamar a un método personalizado del repositorio (siguiente paso)
            $results = $supplementRepository->searchByName($query);
        }

        

        return $this->render('search_barre/index.html.twig', [
            'form' => $form->createView(),
            'results' => $results,
        ]);
    }
}
