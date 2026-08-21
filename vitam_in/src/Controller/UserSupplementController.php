<?php

namespace App\Controller;

use App\Entity\UserSupplement;
use App\Form\UserSupplementType;
use App\Repository\UserSupplementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user/supplement')]
final class UserSupplementController extends AbstractController
{
    #[Route(name: 'app_user_supplement_index', methods: ['GET'])]
    public function index(UserSupplementRepository $userSupplementRepository): Response
    {
        return $this->render('user_supplement/index.html.twig', [
            'user_supplements' => $userSupplementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_supplement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $userSupplement = new UserSupplement();
        $form = $this->createForm(UserSupplementType::class, $userSupplement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($userSupplement);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_supplement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_supplement/new.html.twig', [
            'user_supplement' => $userSupplement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_supplement_show', methods: ['GET'])]
    public function show(UserSupplement $userSupplement): Response
    {
        return $this->render('user_supplement/show.html.twig', [
            'user_supplement' => $userSupplement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_supplement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserSupplement $userSupplement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserSupplementType::class, $userSupplement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_supplement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_supplement/edit.html.twig', [
            'user_supplement' => $userSupplement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_supplement_delete', methods: ['POST'])]
    public function delete(Request $request, UserSupplement $userSupplement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userSupplement->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($userSupplement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_supplement_index', [], Response::HTTP_SEE_OTHER);
    }
}
