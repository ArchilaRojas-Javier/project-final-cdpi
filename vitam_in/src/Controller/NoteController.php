<?php

namespace App\Controller;

use App\Entity\Note;
use App\Entity\UserSupplement;
use App\Form\NoteType;
use App\Repository\NoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;



#[Route('/note')]
#[IsGranted('ROLE_USER')]

final class NoteController extends AbstractController
{
   #[Route('/new/{userSupplement}', name: 'app_note_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserSupplement $userSupplement, EntityManagerInterface $entityManager): Response
    {
        if ($userSupplement->getUser() !== $this->getUser()) {
            throw new AccessDeniedException('Vous n\'avez pas le droit de ajouter de notes pour cet utilisateur.');
        }
        $note = new Note();
        $note->setUserSupplement($userSupplement);
        $note->setCreatedAt(new \DateTimeImmutable()); 

        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($note);
            $entityManager->flush();
            $this->addFlash('success', 'Note ajoutée avec succès.');
            return $this->redirectToRoute('app_notes_by_supplement', ['id' => $userSupplement->getId()]);
        }

        return $this->render('note/new.html.twig', [
            'form' => $form->createView(),
            'userSupplement' => $userSupplement,
        ]);
    }

    #[Route('/us/{id}/notes', name: 'app_notes_by_supplement', methods: ['GET'])]
    public function notesBySupplement(UserSupplement $userSupplement, NoteRepository $noteRepository): Response
    {
        
        $notes = $noteRepository->findByUserSupplement( $userSupplement);

        return $this->render('note/index.html.twig', [
            'notes' => $notes,
            'userSupplement' => $userSupplement, 
        ]);
    }

    #[Route('/{id}/edit', name: 'app_note_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Note $note, EntityManagerInterface $entityManager): Response
    {
        if ($note->getUserSupplement()->getUser() !== $this->getUser()) {
            throw new AccessDeniedException('Vous n\'avez pas le droit de modifier ce note.');
        }
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);
        $userSupplement = $note->getUserSupplement(); 

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Note modifié avec succès.');
            return $this->redirectToRoute('app_notes_by_supplement', [
                'id' => $userSupplement->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('note/edit.html.twig', [
            'note' => $note,
            'form' => $form,
            'userSupplement' => $note->getUserSupplement()
        ]);
    }

    #[Route('/{id}', name: 'app_note_delete', methods: ['POST'])]
    public function delete(Request $request, Note $note, EntityManagerInterface $entityManager): Response
    {
        if ($note->getUserSupplement()->getUser() !== $this->getUser()) {
            throw new AccessDeniedException('Vous n\'avez pas le droit de supprimer ce note.');
        }
        
        if ($this->isCsrfTokenValid('delete'.$note->getId(), $request->getPayload()->getString('_token'))) {
            $userSupplement = $note->getUserSupplement(); 
            $entityManager->remove($note);
            $entityManager->flush();
        }

         return $this->redirectToRoute('app_notes_by_supplement', [
                'id' => $userSupplement->getId()
            ], Response::HTTP_SEE_OTHER);
    }
}
