<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\UserSupplement;
use Doctrine\ORM\EntityManagerInterface;
use Google\Client as GoogleClient;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Google\Service\Calendar\EventDateTime;
use Google\Service\Calendar\EventReminder;
use Google\Service\Calendar\EventReminders;
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
        string $defaultTimeZone = 'Europe/Paris'// can change if we have the timezome of browser to be specific
    ) {
        $this->entityManagerInterface = $entityManagerInterface;
        $this->logger = $logger;
        $this->defaultTimeZone = $defaultTimeZone;
        $this->client = new GoogleClient();
        $this->client->setClientId($googleCalendarConfig['client_id']);
        $this->client->setClientSecret($googleCalendarConfig['client_secret']);
        $this->client->addScope(Calendar::CALENDAR_EVENTS);
       
    }

    /**
     * Create an event on the user's primary calendar.
     * @param User $user The user that authorizes the creation (must have a valid access token)
     * @param UserSupplement $userSupplement The supplement to be added
     * @return string|null The ID of the created event, or null if it fails (or throws an exception)
     * @throws \Exception
     */
    public function createUserSupplementEvent(User $user, UserSupplement $userSupplement): ?string
    {
        
        $summary = 'Prise de: ' . $userSupplement->getSupplement()->getName();
        $dosage = $userSupplement->getDosageSchedule();
        $doseText = $dosage['dose'] ?? 'N/A';
        $unitText = $dosage['unit'] ?? '';
        $timeText = $dosage['time'] ?? '';
        $durationDays = $userSupplement->getDurationDays();
        $startDate = $userSupplement->getStartDate();
        $description = sprintf(
            "Dosage: %s %s\nDurée: %d jours",
            $doseText,
            $unitText,
            $timeText,
            $durationDays
        );
        
        //Create event in Google Calendar and get ID
        $eventId = $this->createEvent($user, $summary, $description, $startDate, $durationDays, $timeText);

        //Add and persist Reminder
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
     * Generic method to create an event (full day).
     *
     * @throws \Exception
     */
    public function createEvent(User $user, string $summary, string $description, \DateTimeInterface $startDate, int $durationDays, string $timeText): string
    {
        // Ensure valid token
        $this->ensureValidAccessToken($user);

        // Create Calendar service
        $service = new Calendar($this->client);

        // Prepare event data
        // Convert to DateTimeImmutable to use setTime()
        $timeParts = explode(':', $timeText);
        $hours = (int) ($timeParts[0] ?? 0);
        $minutes = (int) ($timeParts[1] ?? 0);
        $seconds = (int) ($timeParts[2] ?? 0);

        $start = $startDate instanceof \DateTimeImmutable
            ? $startDate
            : \DateTimeImmutable::createFromMutable($startDate);
        $start = $start->setTimezone(new \DateTimeZone($this->defaultTimeZone));
        $start = $start->setTime($hours, $minutes, $seconds);
        $end = $start->modify('+1 hour');
        
        // Create event object
        $event = new Event();
        $event->setSummary($summary);
        $event->setDescription($description);

        $startEventDateTime = new EventDateTime();
        $startEventDateTime->setDateTime($start->format('Y-m-d\TH:i:s'));
        $startEventDateTime->setTimeZone($this->defaultTimeZone);
        $event->setStart($startEventDateTime);

        $endEventDateTime = new EventDateTime();
        $endEventDateTime->setDateTime($end->format('Y-m-d\TH:i:s'));
        $endEventDateTime->setTimeZone($this->defaultTimeZone);
        $event->setEnd($endEventDateTime);
    

        $event->setRecurrence([
            'RRULE:FREQ=DAILY;COUNT=' . $durationDays  // Se repite N días
        ]);

        $reminderOverrides = new EventReminder();
        $reminderOverrides->setMethod('popup');
        $reminderOverrides->setMinutes(10);

        $eventReminders = new EventReminders();
        $eventReminders->setUseDefault(false);
        $eventReminders->setOverrides([$reminderOverrides]);

        $event->setReminders($eventReminders);

     // Create the event in Google Calendar
        try {
            $createdEvent = $service->events->insert('primary', $event);
            return $createdEvent->getId();
        } catch (\Exception $e) {
            $this->logger->error("Erreur lors de la création de l'événement dans Google Calendar", [
                'user_id' => $user->getId(),
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Le événement n'a pas pu être créé: " . $e->getMessage());
        }
    }

    /**
     * Met à jour un événement Google Calendar existant pour un userSupplement donné.
     * 
     * @param UserSupplement $userSupplement L'entité contenant les nouvelles données
     * @param string $eventId L'ID de l'événement à mettre à jour
     * @throws \RuntimeException En cas d'échec de la mise à jour
     */
    public function updateEvent(UserSupplement $userSupplement, string $eventId): void
    {
        $user = $userSupplement->getUser();
        $this->ensureValidAccessToken($user);

        $supplement = $userSupplement->getSupplement();
        $dosage = $userSupplement->getDosageSchedule();
        $durationDays = $userSupplement->getDurationDays();
        $startDate = $userSupplement->getStartDate();
        $dose = $dosage['dose'] ?? 'N/A';
        $unit = $dosage['unit'] ?? '';
        $time = $dosage['time'] ?? '00:00:00';

        $summary = sprintf('Prise de: %s', $supplement->getName());

        $description = sprintf(
            "Dosage: %s %s\nHeure: %s\nDurée: %d jours",
            $dose,
            $unit,
            $time,
            $durationDays
        );

        // Traitement de l'heure
        $timeParts = explode(':', $time);
        $hours = (int) ($timeParts[0] ?? 0);
        $minutes = (int) ($timeParts[1] ?? 0);
        $seconds = (int) ($timeParts[2] ?? 0);

        
        $start = $startDate;

        $timezone = new \DateTimeZone($this->defaultTimeZone);
        $start = (clone $startDate)
            ->setTimezone($timezone)
            ->setTime($hours, $minutes, $seconds);

        $end = (clone $start)->modify('+1 hour');

        $service = new Calendar($this->client);

        try {
            // Récupération de l'événement existant
            $event = $service->events->get('primary', $eventId);

            $event->setSummary($summary);
            $event->setDescription($description);

            $startEventDateTime = new EventDateTime();
            $startEventDateTime->setDateTime($start->format('Y-m-d\TH:i:s'));
            $startEventDateTime->setTimeZone($this->defaultTimeZone);
            $event->setStart($startEventDateTime);

            $endEventDateTime = new EventDateTime();
            $endEventDateTime->setDateTime($end->format('Y-m-d\TH:i:s'));
            $endEventDateTime->setTimeZone($this->defaultTimeZone);
            $event->setEnd($endEventDateTime);

            if ($durationDays > 1) {
                
                $event->setRecurrence([
                    sprintf('RRULE:FREQ=DAILY;COUNT=%d', $durationDays)
                ]);
            } else {
                
                $event->setRecurrence(null);
            }

            $reminderOverride = new EventReminder();
            $reminderOverride->setMethod('popup');
            $reminderOverride->setMinutes(10);

            $eventReminders = new EventReminders();
            $eventReminders->setUseDefault(false);
            $eventReminders->setOverrides([$reminderOverride]);
            $event->setReminders($eventReminders);

            $service->events->update('primary', $eventId, $event);

        } catch (\Google\Service\Exception $e) {
            throw new \RuntimeException("Impossible de mettre à jour l'événement");
        } catch (\Exception $e) {
            
            throw new \RuntimeException("Une erreur est survenue lors de la mise à jour de l'événement.");
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
            $this->logger->error("Erreur lors de la suppression de l'événement dans Google Calendar", [
                'user_id' => $user->getId(),
                'event_id' => $eventId,
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Le événement n'a pas pu être supprimé: " . $e->getMessage());
        }
    }

    /**
     * Verify and renew the access token if necessary.
     * Update the User entity with the new token.
     * @throws \Exception
     */
    private function ensureValidAccessToken(User $user): void
    {
        $accessToken = $user->getGoogleAccessToken();
        if (!$accessToken) {
            throw new \RuntimeException("L'utilisateur ne possède pas de jeton d'accès Google.");
        }

        // Configurez le client avec le token stocké
        $this->client->setAccessToken($accessToken);

        // If it has expired, try refreshing.
        if ($this->client->isAccessTokenExpired()) {
            $refreshToken = $user->getGoogleRefreshToken();
            if (!$refreshToken) {
                throw new \RuntimeException("Le token a expiré et il n y a pas de token de rafraîchissement. L utilisateur doit se reconnecter.");
            }

            try {
                // Refresh token
                $this->client->refreshToken($refreshToken);
                $newToken = $this->client->getAccessToken();

                // Update the access_token in the entity
                $user->setGoogleAccessToken($newToken);
                // If Google returns a new refresh_token
                if (isset($newToken['refresh_token'])) {
                    $user->setGoogleRefreshToken($newToken['refresh_token']);
                }
                // Persist changes
                $this->entityManagerInterface->persist($user);
                $this->entityManagerInterface->flush();
            } catch (\Exception $e) {
                $this->logger->error("Erreur lors de l'actualisation du jeton Google", [
                    'user_id' => $user->getId(),
                    'error' => $e->getMessage(),
                ]);
                throw new \RuntimeException("Le jeton d'accès n'a pas pu être renouvelé.: " . $e->getMessage());
            }
        }
    }
}