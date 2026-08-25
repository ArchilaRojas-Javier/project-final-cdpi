<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\UserSupplement;
use Doctrine\ORM\EntityManagerInterface;
use Google\Client as GoogleClient;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Google\Service\Calendar\EventDateTime;
use App\Entity\Reminder;
use Psr\Log\LoggerInterface;

class GoogleCalendarService
{
    private GoogleClient $client;
    private EntityManagerInterface $entityManagerInterface;
    private LoggerInterface $logger;
    private string $defaultTimeZone;

    public function __construct(
        array $googleCalendarConfig,
        EntityManagerInterface $entityManagerInterface,
        LoggerInterface $logger,
        string $defaultTimeZone = 'UTC'
    ) {
        $this->entityManagerInterface = $entityManagerInterface;
        $this->logger = $logger;
        $this->defaultTimeZone = $defaultTimeZone;

        $this->client = new GoogleClient();
        $this->client->setClientId($googleCalendarConfig['client_id']);
        $this->client->setClientSecret($googleCalendarConfig['client_secret']);
        // $this->client->setRedirectUri($googleCalendarConfig['redirect_uri']);
        $this->client->addScope(Calendar::CALENDAR_EVENTS);
        $this->client->setAccessType('offline');
        $this->client->setPrompt('consent');
    }

    /**
     * Crea un evento en el calendario principal del usuario a partir de un suplemento.
     * @param User $user El usuario que autoriza la creación (debe tener un access token válido)
     * @param UserSupplement $userSupplement El suplemento que se va a añadir
     * @return string|null El ID del evento creado, o null si falla (o lanza excepción)
     * @throws \Exception
     */
    public function createUserSupplementEvent(User $user, UserSupplement $userSupplement): ?string
    {
        //ver pasar los datos directos para no pasar el objeto completo, solo los datos necesarios para crear el evento
        $summary = 'Suivi: ' . $userSupplement->getSupplement()->getName();// nombre de suplemento
        $dosage = $userSupplement->getDosageSchedule();
        $doseText = $dosage['dose'] ?? 'N/A';
        $unitText = $dosage['unit'] ?? '';
        $durationDays = $userSupplement->getDurationDays();
        $startDate = $userSupplement->getStartDate();
        $description = sprintf(
            "Dosage: %s %s\nDurée: %d jours",
            $doseText,
            $unitText,
            $durationDays
        );
        //calcular cuantos dias le quedan al suplemento y ponerlo en la descripcion

        
        // 1. Crear evento en Google Calendar y obtener ID
        $eventId = $this->createEvent($user, $summary, $description, $startDate, $durationDays);

        // 2. Crear y persistir el Reminder
        $reminder = new Reminder();
        $reminder->setGoogleEventId($eventId);
        $reminder->setIsActive(true);
        $reminder->setCreatedAt(new \DateTimeImmutable());
        $reminder->setUserSupplement($userSupplement); // importante: $supplement ya debe tener ID

        $this->entityManagerInterface->persist($reminder);
        $this->entityManagerInterface->flush();

        return $eventId;
    }

    /**
     * Método genérico para crear un evento (día completo).
     *
     * @throws \Exception
     */
    public function createEvent(User $user, string $summary, string $description, \DateTimeInterface $startDate, int $durationDays): string
    {
        // 1. Asegurar token válido
        $this->ensureValidAccessToken($user);

        // 2. Crear servicio de Calendar
        $service = new Calendar($this->client);

        // 3. Preparar fechas (todo el día)
           // Convertir a DateTimeImmutable para usar setTime()
    $start = $startDate instanceof \DateTimeImmutable
        ? $startDate
        : \DateTimeImmutable::createFromMutable($startDate);
    $start = $start->setTime(0, 0, 0);
    $end = $start->modify("+{$durationDays} days");

        $event = new Event();
        $event->setSummary($summary);
        $event->setDescription($description);

        $startEventDateTime = new EventDateTime();
        $startEventDateTime->setDate($start->format('Y-m-d'));
        $startEventDateTime->setTimeZone($this->defaultTimeZone);
        $event->setStart($startEventDateTime);

        $endEventDateTime = new EventDateTime();
        $endEventDateTime->setDate($end->format('Y-m-d'));
        $endEventDateTime->setTimeZone($this->defaultTimeZone);
        $event->setEnd($endEventDateTime);

        // 4. Insertar evento
        try {
            $createdEvent = $service->events->insert('primary', $event);
            return $createdEvent->getId();
        } catch (\Exception $e) {
            $this->logger->error('Error al crear evento en Google Calendar', [
                'user_id' => $user->getId(),
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException('No se pudo crear el evento en Google Calendar: ' . $e->getMessage());
        }
    }

    /**
     * Actualiza un evento existente.
     */
    public function updateEvent(User $user, string $eventId, string $summary, string $description, \DateTimeInterface $startDate, int $durationDays): void
    {
        $this->ensureValidAccessToken($user);
        $service = new Calendar($this->client);

        try {
            $event = $service->events->get('primary', $eventId);
            $event->setSummary($summary);
            $event->setDescription($description);

            $start = $startDate instanceof \DateTimeImmutable
                ? $startDate
                : \DateTimeImmutable::createFromMutable($startDate);
            $start = $start->setTime(0, 0, 0);
            $end = $start->modify("+{$durationDays} days");

            $startEventDateTime = new EventDateTime();
            $startEventDateTime->setDate($start->format('Y-m-d'));
            $startEventDateTime->setTimeZone($this->defaultTimeZone);
            $event->setStart($startEventDateTime);

            $endEventDateTime = new EventDateTime();
            $endEventDateTime->setDate($end->format('Y-m-d'));
            $endEventDateTime->setTimeZone($this->defaultTimeZone);
            $event->setEnd($endEventDateTime);

            $service->events->update('primary', $eventId, $event);
        } catch (\Exception $e) {
            $this->logger->error('Error al actualizar evento en Google Calendar', [
                'user_id' => $user->getId(),
                'event_id' => $eventId,
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException('No se pudo actualizar el evento: ' . $e->getMessage());
        }
    }

    /**
     * Elimina un evento.
     */
    public function deleteEvent(User $user, string $eventId): void
    {
        $this->ensureValidAccessToken($user);
        $service = new Calendar($this->client);

        try {
            $service->events->delete('primary', $eventId);
        } catch (\Exception $e) {
            $this->logger->error('Error al eliminar evento en Google Calendar', [
                'user_id' => $user->getId(),
                'event_id' => $eventId,
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException('No se pudo eliminar el evento: ' . $e->getMessage());
        }
    }

    // -------------------- MÉTODOS PRIVADOS --------------------

    /**
     * Verifica y renueva el token de acceso si es necesario.
     * Actualiza la entidad User con el nuevo token.
     *
     * @throws \Exception
     */
    private function ensureValidAccessToken(User $user): void
    {
        $accessToken = $user->getGoogleAccessToken();
        if (!$accessToken) {
            throw new \RuntimeException('El usuario no tiene token de acceso a Google.');
        }

        // Configurar el cliente con el token almacenado (puede ser un string o array)
        $this->client->setAccessToken($accessToken);

        // Si ha expirado, intentar refrescar
        if ($this->client->isAccessTokenExpired()) {
            $refreshToken = $user->getGoogleRefreshToken();
            if (!$refreshToken) {
                throw new \RuntimeException('El token expiró y no hay refresh token. El usuario debe autenticarse de nuevo.');
            }

            try {
                // Refrescar token
                $this->client->refreshToken($refreshToken);
                $newToken = $this->client->getAccessToken();

                // Actualizar el access_token en la entidad
                $user->setGoogleAccessToken($newToken['access_token'] ?? null);
                // Si Google devuelve un nuevo refresh_token (raro), actualizarlo
                if (isset($newToken['refresh_token'])) {
                    $user->setGoogleRefreshToken($newToken['refresh_token']);
                }

                // Persistir cambios en la base de datos
                $this->entityManagerInterface->persist($user);
                $this->entityManagerInterface->flush();
            } catch (\Exception $e) {
                $this->logger->error('Error al refrescar token de Google', [
                    'user_id' => $user->getId(),
                    'error' => $e->getMessage(),
                ]);
                throw new \RuntimeException('No se pudo renovar el token de acceso: ' . $e->getMessage());
            }
        }
    }
}