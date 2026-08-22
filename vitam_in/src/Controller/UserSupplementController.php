<?php

namespace App\Controller;

use App\Form\UserSupplementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Service\UserSupplementService;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

#[Route('/user/supplement')]
#[IsGranted('ROLE_USER')]
final class UserSupplementController extends AbstractController
{
   #[Route('/new/{supplementId}', name: 'app_user_supplement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserSupplementService $userSupplementService, int $supplementId): Response {
   
        $user = $this->getUser();
        if (!$user) {
            throw new AccessDeniedException('Vous devez être connecté pour effectuer cette action.');
        }

        try {
            $userSupplement = $userSupplementService->createUserSupplementFromSupplementId($supplementId);
        } catch (\InvalidArgumentException $e) {
            $this->addFlash('error', $e->getMessage());
            return $this->redirectToRoute('app_dashboard');
        }

        $existing = $userSupplementService->findExistingUserSupplement($user, $userSupplement->getSupplement());
        if ($existing) {
            $this->addFlash('warning', 'Vous avez déjà ajouté ce supplément à votre liste.');
            return $this->redirectToRoute('app_dashboard');
        }

        $form = $this->createForm(UserSupplementType::class, $userSupplement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userSupplement->setDosageSchedule($form->get('dosageScheduleDose')->getData());

            $userSupplementService->persistWithUser($userSupplement, $user);

            $this->addFlash('success', 'Supplément enregistré avec succès.');
            return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_supplement/new.html.twig', [
            'user_supplement' => $userSupplement,
            'form' => $form,
        ]);
    }

    // #[Route('/{id}', name: 'app_user_supplement_show', methods: ['GET'])]
    // public function show(UserSupplement $userSupplement): Response
    // {
    //     return $this->render('user_supplement/show.html.twig', [
    //         'user_supplement' => $userSupplement,
    //     ]);
    // }

    // #[Route('/{id}/edit', name: 'app_user_supplement_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, UserSupplement $userSupplement, EntityManagerInterface $entityManager): Response
    // {
    //     $form = $this->createForm(UserSupplementType::class, $userSupplement);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_user_supplement_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('user_supplement/edit.html.twig', [
    //         'user_supplement' => $userSupplement,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'app_user_supplement_delete', methods: ['POST'])]
    // public function delete(Request $request, UserSupplement $userSupplement, EntityManagerInterface $entityManager): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$userSupplement->getId(), $request->getPayload()->getString('_token'))) {
    //         $entityManager->remove($userSupplement);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('app_user_supplement_index', [], Response::HTTP_SEE_OTHER);
    // }
}
