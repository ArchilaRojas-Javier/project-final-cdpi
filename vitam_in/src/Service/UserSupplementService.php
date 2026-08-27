<?php
namespace App\Service;

use App\Entity\Supplement;
use App\Entity\UserSupplement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserSupplementService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Recherchez un supplément par son identifiant et créez un UserSupplement avec les valeurs par défaut.
     *
     * @throws \Exception Si le supplément n'existe pas.
     */
    public function createUserSupplementFromSupplementId(int $supplementId): UserSupplement
    {
        $supplement = $this->entityManager->getRepository(Supplement::class)->find($supplementId);
        if (!$supplement) {
            throw new \InvalidArgumentException('Supplément introuvable');
        }

        $userSupplement = new UserSupplement();
        $userSupplement->setSupplement($supplement);
        $userSupplement->setDurationDays($supplement->getOnDurationDays());
        $userSupplement->setPrecautions($supplement->getPrecautions());
        $userSupplement->setStartDate(new \DateTimeImmutable());

        // Sélection du dosage en fonction du sexe de l'utilisateur (ou général par défaut)
        $dosageSchedule = $supplement->getDosageSchedule();
        $selectedDosageSchedule = $dosageSchedule['userSex'] ?? $dosageSchedule['general'];
        $userSupplement->setDosageSchedule($selectedDosageSchedule);

        return $userSupplement;
    }

    /**
     * Vérifiez si l'utilisateur possède déjà ce supplément.
     */
    public function findExistingUserSupplement(UserInterface $user, int $supplementId): ?UserSupplement
    {
        return $this->entityManager
            ->getRepository(UserSupplement::class)
            ->findOneBy([
                'user' => $user,
                'supplement' => $supplementId
            ]);
    }

    /**
     * Attribuez l'utilisateur authentifié à l'objet UserSupplement et persistez-le dans la base de données.
     */
    public function persistWithUser(UserSupplement $userSupplement, UserInterface $user): void
    {
        $userSupplement->setUser($user);
        $this->entityManager->persist($userSupplement);
        $this->entityManager->flush();
    }
}