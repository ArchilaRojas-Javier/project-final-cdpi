<?php

namespace App\Service;

use Google\Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Google\Service\Calendar\EventDateTime;
use App\Entity\User;
use App\Entity\UserSupplement;

class GoogleCalendarService{}
// {
//     private Client $client;

//     public function __construct(string $googleClientId, string $googleClientSecret, string $googleRedirectUri)
//     {
//         $this->client = new Client();
//         $this->client->setClientId($googleClientId);
//         $this->client->setClientSecret($googleClientSecret);
//         $this->client->setRedirectUri($googleRedirectUri);
//         $this->client->setScopes([
//             Calendar::CALENDAR_EVENTS,
//             // Si quieres solo eventos, usa Calendar::CALENDAR_EVENTS
//         ]);
//         $this->client->setAccessType('offline');
//         $this->client->setPrompt('select_account consent');
//     }

//     /**
//      * Crea un evento en el calendario principal del usuario.
//      *
//      * @param User $user El usuario que autoriza la creación (debe tener un access token válido)
//      * @param UserSupplement $userSupplement El suplemento que se va a añadir
//      * @return string|null El ID del evento creado, o null si falla
//      */
//     public function createSupplementEvent(User $user, UserSupplement $userSupplement): ?string
//     {
//         // Verificar que el usuario tenga un token de acceso
//         $accessToken = $user->getGoogleAccessToken();
//         if (!$accessToken) {
//             throw new \Exception('El usuario no tiene token de acceso a Google');
//         }

//         // Configurar el cliente con el token del usuario
//         $this->client->setAccessToken($accessToken);

//         // Si el token ha expirado, intentar refrescarlo (si tenemos refresh token)
//         if ($this->client->isAccessTokenExpired()) {
//             $refreshToken = $user->getGoogleRefreshToken();
//             if ($refreshToken) {
//                 $this->client->fetchAccessTokenWithRefreshToken($refreshToken);
//                 // Guardar el nuevo token en la base de datos
//                 $newAccessToken = $this->client->getAccessToken();
//                 $user->setGoogleAccessToken($newAccessToken);
//                 // Persistir el usuario (esto debe hacerse fuera del servicio o inyectar EntityManager)
//                 // Lo mejor es que el servicio reciba EntityManager para actualizar el token.
//             } else {
//                 throw new \Exception('El token ha expirado y no hay refresh token. El usuario debe volver a autenticarse.');
//             }
//         }

//         $calendarService = new Calendar($this->client);

//         // Construir el evento
//         $event = new Event();
//         $event->setSummary('Suivi: ' . $userSupplement->getSupplement()->getName());
//         $event->setDescription('Dosage: ' . $userSupplement->getDosageSchedule()['dose'] . ' ' . $userSupplement->getDosageSchedule()['unit'] . "\n" .
//                                'Durée: ' . $userSupplement->getDurationDays() . ' jours');

//         // Fechas (asumimos evento de todo el día o con hora fija? 
//         // Podemos poner a las 9:00 AM como inicio)
//         $startDate = $userSupplement->getStartDate();
//         $duration = $userSupplement->getDurationDays();

//         $startDateTime = (clone $startDate)->setTime(9, 0, 0);
//         $endDateTime = (clone $startDateTime)->modify("+{$duration} days");

//         $event->setStart(new EventDateTime([
//             'dateTime' => $startDateTime->format(\DateTime::RFC3339),
//             'timeZone' => 'Europe/Paris', // O la zona horaria del usuario
//         ]));
//         $event->setEnd(new EventDateTime([
//             'dateTime' => $endDateTime->format(\DateTime::RFC3339),
//             'timeZone' => 'Europe/Paris',
//         ]));

//         // Insertar evento en el calendario principal ("primary")
//         $createdEvent = $calendarService->events->insert('primary', $event);

//         return $createdEvent->getId();
//     }

    // Método para actualizar un evento (si se edita el suplemento)
    // Método para eliminar un evento (si se borra el suplemento)
//     <?php

// namespace App\Service;

// use App\Entity\User;
// use Google\Client as GoogleClient;
// use Google\Service\Calendar;
// use Google\Service\Calendar\Event;
// use Google\Service\Calendar\EventDateTime;
// use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

// class GoogleCalendarService
// {
//     private GoogleClient $client;
//     private array $config;

//     public function __construct(ParameterBagInterface $params)
//     {
//         $this->config = $params->get('google_calendar');
        
//         $this->client = new GoogleClient();
//         $this->client->setClientId($this->config['client_id']);
//         $this->client->setClientSecret($this->config['client_secret']);
//         // $this->client->setRedirectUri($this->config['redirect_uri']);
//         $this->client->addScope(Calendar::CALENDAR_EVENTS);
//         $this->client->setAccessType('offline');
//         $this->client->setPrompt('consent');
//     }

//     /**
//      * Crée un événement dans Google Calendar
//      *
//      * @param User $user L'utilisateur connecté (doit avoir un access_token)
//      * @param string $summary Titre de l'événement
//      * @param string $description Description
//      * @param \DateTimeInterface $startDate Date de début
//      * @param int $durationDays Durée en jours
//      * @return Event|null L'événement créé ou null en cas d'erreur
//      */
//     public function createEvent(
//         User $user,
//         string $summary,
//         string $description,
//         \DateTime|\DateTimeImmutable $startDate,
//         int $durationDays
//     ): ?Event {
//         try {
//             // Récupérer le token de l'utilisateur
//             $accessToken = $user->getGoogleAccessToken();
//             if (!$accessToken) {
//                 throw new \Exception('Token d\'accès Google manquant.');
//             }

//             // Configurer le client avec le token
//             $this->client->setAccessToken($accessToken);
            
//             // Vérifier si le token a expiré et le rafraîchir si nécessaire
//             if ($this->client->isAccessTokenExpired()) {
//                 $refreshToken = $user->getGoogleRefreshToken();
//                 if ($refreshToken) {
//                     $this->client->refreshToken($refreshToken);
//                     // Mettre à jour le token dans la base de données
//                     $newAccessToken = $this->client->getAccessToken();
//                     $user->setGoogleAccessToken($newAccessToken['access_token']);
//                     $user->setGoogleRefreshToken($newAccessToken['refresh_token'] ?? $refreshToken);
//                     // Le persist/flush sera fait dans le contrôleur
//                 } else {
//                     throw new \Exception('Token d\'accès expiré et aucun refresh token disponible.');
//                 }
//             }

//             // Créer le service Calendar
//             $service = new Calendar($this->client);

//             // Calculer la date de fin
//             $startDateTime = $startDate instanceof \DateTimeImmutable
//                 ? $startDate
//                 : \DateTimeImmutable::createFromMutable($startDate);
//             $endDate = $startDateTime->modify("+{$durationDays} days");

//             // Créer l'événement
//             $event = new Event();
//             $event->setSummary($summary);
//             $event->setDescription($description);

//             // Définir les dates (toute la journée)
//             $start = new EventDateTime();
//             $start->setDate($startDateTime->format('Y-m-d'));
//             $start->setTimeZone('UTC');
//             $event->setStart($start);

//             $end = new EventDateTime();
//             $end->setDate($endDate->format('Y-m-d'));
//             $end->setTimeZone('UTC');
//             $event->setEnd($end);

//             // Ajouter l'événement au calendrier principal
//             $calendarId = 'primary';
//             $createdEvent = $service->events->insert($calendarId, $event);

//             return $createdEvent;
//         } catch (\Exception $e) {
//             // Log l'erreur et retourner null
//             // Tu peux utiliser un logger ici
//             // $this->logger->error('Erreur création événement Google Calendar: ' . $e->getMessage());
//             return null;
//         }
//     }
// }
// }