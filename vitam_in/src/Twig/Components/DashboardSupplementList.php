<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use App\Entity\UserSupplement;
use App\Form\UserSupplementType;
use App\Repository\UserSupplementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


// [AsLiveComponent('dashboard_supplement_list')]
// class DashboardSupplementList
#[AsLiveComponent]
final class DashboardSupplementList
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;   // Para manejar formularios de edición

    #[LiveProp]                   // Propiedad reactiva: al cambiarla se re-renderiza
    public ?int $editingId = null;

    #[LiveProp]
    // #[LiveProp(useSerializerForHydration: true)]
    public array $userSupplements = [];

    private Security $security;
    private UserSupplementRepository $userSupplementRepository;
    private EntityManagerInterface $entityManager;
    private RouterInterface $router;
    private FormFactoryInterface $formFactory;

    public function __construct(
        Security $security,
        UserSupplementRepository $userSupplementRepository,
        EntityManagerInterface $entityManager,
        RouterInterface $router,
        FormFactoryInterface $formFactory 
        
    ) {
        $this->security = $security;
        $this->userSupplementRepository = $userSupplementRepository;
        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->formFactory = $formFactory;
        
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
     *  */
    $userSupplementData = $this->userSupplementRepository->findByUser($user);

    $this->userSupplements = array_map(function (UserSupplement $us) {
        
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
                $dosageSummary = '0'; // Valeur par défaut si aucune information sur la dose n'est disponible
            }
        
        return [
            'id'               => $us->getId(),
            'supplementName'   => $supplementName,
            'startDate'        => $startDate->format('Y-m-d'),
            'durationDays'     => $duration,
            'daysRemaining'    => $daysRemaining,
            'dosageSummary'    => $dosageSummary,
            'notesCount'       => $us->getNotes()->count(),
        ];
    }, $userSupplementData);
}

    // Construye el formulario de edición (usado solo cuando editingId no es null)
    protected function instantiateForm(): FormInterface
    {
        $userSupplement = null;
        
        if ($this->editingId) {
            $userSupplement = $this->userSupplementRepository->findById($this->editingId);
            // Seguridad: verificar que el dueño sea el usuario logueado
            if (!$userSupplement || $userSupplement->getUser() !== $this->security->getUser()) {
               throw new AccessDeniedException('No tienes permiso para editar esto.');
            }
        } else {
            // Si no hay ID, creamos uno nuevo (aunque no uses creación aquí, es buena práctica)
            $userSupplement = new UserSupplement();
            $userSupplement->setUser($this->security->getUser());
        }

        return $this->formFactory->create(UserSupplementType::class, $userSupplement);
    }
    // Acción al hacer clic en "Editar"
    #[LiveAction]
    public function startEdit(int $id): void
    {
        $this->editingId = $id;
    }

    // Acción al cancelar edición
    #[LiveAction]
    public function cancelEdit(): void
    {
        $this->editingId = null;
    }

    // Acción al guardar el formulario de edición
    #[LiveAction]
    public function saveEdit(): void
    {
        // Procesa el formulario con los datos enviados
        $this->submitForm();
        $form = $this->getForm();

        if ($form->isSubmitted() && $form->isValid()) {
            
        /** @var UserSupplement $userSupplement */
            $userSupplement = $form->getData();
            
            // Asegurar que el usuario sea el mismo (por si acaso)
            $userSupplement->setUser($this->security->getUser());

            // Convertir dosage_schedule a array si viene como string
            // $dosage = $userSupplement->getDosageSchedule();
            // if (is_string($dosage)) {
            //     // Si es un string, lo convertimos a array (por ejemplo, líneas)
            //     $lines = explode("\n", $dosage);
            //     $userSupplement->setDosageSchedule(array_filter($lines, fn($l) => trim($l) !== ''));
            // }
            
            $this->entityManager->persist($userSupplement);
            $this->entityManager->flush();

            $this->editingId = null;
            
            $this->mount(); // Refresca la lista
        }
        // Si hay errores, el componente se re-renderiza y los muestra
    }

    // Acción para borrar un suplemento
    #[LiveAction]
    public function delete(int $id): void
        {
        $user = $this->security->getUser();
        $userSupplement = $this->userSupplementRepository->find($id);

        if (!$userSupplement || $userSupplement->getUser() !== $user) {
            throw new AccessDeniedException();
        }

        $this->entityManager->remove($userSupplement);
        $this->entityManager->flush();

        if ($this->editingId === $id) {
            $this->editingId = null;
        }
        $this->mount();
    }

    // Métodos auxiliares para el template
        public function getDaysRemaining(UserSupplement $userSupplement): int
    {
                $start = $userSupplement->getStartDate();
        $duration = $userSupplement->getDurationDays();
        if (!$start || !$duration) {
            return 0;
        }
        $end = $start->modify("+{$duration} days");
        $today = new \DateTimeImmutable();
        if ($end < $today) {
            return 0;
        }
        return $today->diff($end)->days;
    }

    public function getNoteCount(UserSupplement $userSupplement): int
    {
        return $userSupplement->getNotes()->count(); // Asumiendo que tienes OneToMany
    }

    public function getDosageSummary(UserSupplement $userSupplement): string
    {
        $schedule = $userSupplement->getDosageSchedule();
        if (empty($schedule)) {
            return 'No definida';
        }
        if (is_array($schedule)) {
            // Si es un array, lo mostramos como lista separada por comas
            return implode(', ', $schedule);
        }
        return (string) $schedule;
    }

    // Método para obtener el nombre desde la entidad relacionada Supplement
    public function getSupplementName(UserSupplement $userSupplement): string
    {
        return $userSupplement->getSupplement() ? $userSupplement->getSupplement()->getName() : 'Sin nombre';
    }
}
