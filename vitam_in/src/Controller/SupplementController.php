<?php
namespace App\Controller;

use App\Repository\SupplementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SupplementController extends AbstractController
{
    #[Route('/supplement/{id}', name: 'app_supplement_show', requirements: ['id' => '\d+'])]
    public function show(int $id, SupplementRepository $supplementRepository): Response
    {
        $supplement = $supplementRepository->find($id);

        if (!$supplement) {
            throw $this->createNotFoundException('Supplément introuvable.');
        }

        return $this->render('supplement/show.html.twig', [
            'supplement' => $supplement,
        ]);
    }
}