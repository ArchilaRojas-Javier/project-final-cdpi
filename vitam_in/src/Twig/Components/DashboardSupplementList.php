<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use App\Entity\UserSupplement;
use App\Repository\UserSupplementRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

#[AsLiveComponent]
final class DashboardSupplementList
{
    use DefaultActionTrait;

    #[LiveProp]
    public array $userSupplements = [];

    private Security $security;
    private UserSupplementRepository $userSupplementRepository;

    public function __construct(
        Security $security,
        UserSupplementRepository $userSupplementRepository
    ) {
        $this->security = $security;
        $this->userSupplementRepository = $userSupplementRepository;
    }

    /**
     * Ceci s'exécute lorsque le composant est monté
     */
    public function mount(): void
    {
        $user = $this->security->getUser();
        if (!$user) {
            throw new AccessDeniedException('Vous devez vous connecter.');
        }

        /** 
         * récupère toutes les données à utiliser dans le template dans un tableau
         * @var UserSupplement[] $userSupplementData
         */
        $userSupplementData = $this->userSupplementRepository->findByUser($user);

        $this->userSupplements = array_map(function (UserSupplement $us) {
            $supplementId = $us->getSupplement()->getId();
            $supplementName = $us->getSupplement()->getName();
            $startDate = $us->getStartDate();
            $duration = $us->getDurationDays();
            $daysRemaining = 0;
            if ($startDate && $duration) {
                $end = (clone $startDate)->modify("+{$duration} days");
                $today = new \DateTimeImmutable();
                if ($end >= $today) {
                    $daysRemaining = $today->diff($end)->days;
                }
            }

            $schedule = $us->getDosageSchedule();
            if (is_array($schedule) && isset($schedule['dose'], $schedule['unit'])) {
                $dose = $schedule['dose'];
                $unit = $schedule['unit'];
                $dosageSummary = $dose . ' ' . $unit;
            } else {
                $dosageSummary = '0';
            }
        
            return [
                'id'               => $us->getId(),
                'supplementName'   => $supplementName,
                'startDate'        => $startDate->format('Y-m-d'),
                'durationDays'     => $duration,
                'daysRemaining'    => $daysRemaining,
                'dosageSummary'    => $dosageSummary,
                'notesCount'       => $us->getNotes()->count(),
                'supplementId'     => $supplementId,
            ];
        }, $userSupplementData);
    }
}