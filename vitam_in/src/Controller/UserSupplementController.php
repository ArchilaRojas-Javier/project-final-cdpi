<?php

namespace App\Controller;

use App\Entity\UserSupplement;
use App\Entity\User;
use App\Form\UserSupplementType;
use App\Service\UserSupplementService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Service\GoogleCalendarService;



#[Route('/user/supplement')]
#[IsGranted('ROLE_USER')]
final class UserSupplementController extends AbstractController
{
    #[Route('/new/{supplementId}', name: 'app_user_supplement_new', methods: ['GET', 'POST'])]
public function new(Request $request, UserSupplementService $userSupplementService, GoogleCalendarService $googleCalendarService, int $supplementId): Response 
{
    /** @var User $user */
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
        
        $userSupplementService->persistWithUser($userSupplement, $user);
        $this->addFlash('success', 'Supplément enregistré avec succès.');
        
        // Verificar si el usuario quiere crear el evento en Google Calendar
        // Depuración temporal
        $createGoogleEvent = $form->get('google_calendar')->getData();
        // dd($createGoogleEvent);
        
        if ($createGoogleEvent) {
            // Verificar que el usuario tiene token de acceso
            // Depuración temporal
            $accessToken = $user->getGoogleAccessToken();
            if ($accessToken) {

                try {
                    // Usar el método específico para suplementos
                    $eventId = $googleCalendarService->createUserSupplementEvent($user, $userSupplement);
                     

                        if ($eventId){

                            $this->addFlash('success', 'Événement créé dans Google Calendar (ID: ' . $eventId . ').');
                        }
                } catch (\RuntimeException $e) {
                    // Error al crear el evento (token expirado, error de Google, etc.)
                    $this->addFlash('warning', 'Impossible de créer l\'événement Google Calendar : ' . $e->getMessage());
                    // También podrías loguear el error con $this->logger->error(...)
                }
            } else {
                $this->addFlash('warning', 'Tu n\'es pas connecté avec Google. Connecte-toi avec Google pour utiliser cette option.');
            }
        }


        return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
    }

    return $this->render('user_supplement/new.html.twig', [
        'user_supplement' => $userSupplement,
        'form' => $form,
    ]);
}

    #[Route('/{id}/edit', name: 'app_user_supplement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserSupplement $userSupplement, EntityManagerInterface $entityManager): Response
    {
        // Vérifier que l'utilisateur connecté est bien le propriétaire
        if ($userSupplement->getUser() !== $this->getUser()) {
            throw new AccessDeniedException('Vous n\'avez pas le droit de modifier ce supplément.');
        }

        $form = $this->createForm(UserSupplementType::class, $userSupplement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Supplément modifié avec succès.');
            return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_supplement/edit.html.twig', [
            'user_supplement' => $userSupplement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_supplement_delete', methods: ['POST'])]
    public function delete(Request $request, UserSupplement $userSupplement, EntityManagerInterface $entityManager): Response
    {
        // Vérifier que l'utilisateur connecté est bien le propriétaire
        if ($userSupplement->getUser() !== $this->getUser()) {
            throw new AccessDeniedException('Vous n\'avez pas le droit de supprimer ce supplément.');
        }

        if ($this->isCsrfTokenValid('delete' . $userSupplement->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($userSupplement);
            $entityManager->flush();
            $this->addFlash('success', 'Supplément supprimé avec succès.');
        } else {
            $this->addFlash('error', 'Token invalide.');
        }

        return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
    }
}