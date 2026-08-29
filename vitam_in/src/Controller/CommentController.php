<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\SupplementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/comment')]
final class CommentController extends AbstractController
{
    // #[Route(name: 'app_comment_index', methods: ['GET'])]
    // public function index(CommentRepository $commentRepository): Response
    // {
    //     return $this->render('comment/index.html.twig', [
    //         'comments' => $commentRepository->findAll(),
    //     ]);
    // }

    #[Route('/new/comment/{supplementId}', name: 'app_comment_new')]
    public function new(Request $request, int $supplementId, SupplementRepository $supplementRepository,
                        EntityManagerInterface $entityManagerInterface): Response 
    {
        $supplement = $supplementRepository->find($supplementId);
        if (!$supplement) {
            throw $this->createNotFoundException('Supplément introuvable');
        }
        // Verify that the user is logged in.
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $comment = new Comment();
        $comment->setSupplement($supplement);
        $comment->setUser($this->getUser());
        $comment->setCreatedAt(new \DateTimeImmutable());
        $comment->setIsApprouved(true); // por el momento 

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($comment);
            $entityManagerInterface->flush();
            
            return $this->render('supplement/show.html.twig', [
                'supplement' => $supplement,
            ]);
        }

        if ($request->headers->get('turbo-frame') === 'supplement-detail') {
            return $this->render('comment/new_frame.html.twig', [
                'form' => $form->createView(),
                'supplement' => $supplement,
            ]);
        }

        // en cas d'accès direct via l'URL
        return $this->render('comment/new.html.twig', [
            'form' => $form->createView(),
            'supplement' => $supplement,
        ]);
    }

    #[Route('/{id}', name: 'app_comment_show', methods: ['GET'])]
    public function show(Comment $comment): Response
    {
        return $this->render('comment/show.html.twig', [
            'comment' => $comment,
        ]);
    }

    // #[Route('/{id}/edit', name: 'app_comment_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, Comment $comment, EntityManagerInterface $entityManager): Response
    // {
    //     $form = $this->createForm(CommentType::class, $comment);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_comment_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('comment/edit.html.twig', [
    //         'comment' => $comment,
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/{id}', name: 'app_comment_delete', methods: ['POST'])]
    public function delete(Request $request, Comment $comment, EntityManagerInterface $entityManager): Response
    {
        $supplement = $comment->getSupplement();
         if ($comment->getUser() !== $this->getUser()) {
            return $this->render('supplement/show.html.twig', [
            'supplement' => $supplement,
            ]);
        }
        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($comment);
            $entityManager->flush();
        }

        return $this->render('supplement/show.html.twig', [
            'supplement' => $supplement,
        ]);
    }
}
