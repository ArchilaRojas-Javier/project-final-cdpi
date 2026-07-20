## 🎯 SYNTHÈSE DU PROJET

**Nom du projet** : Vitam-in  
**Candidat** : Javier Archila Rojas
**Date** : 09/2026

### Contexte
Ce projet est né d’un besoin personnel : consommer des compléments vitaminiques de manière éclairée et régulière.  
Il est difficile de trouver facilement des informations fiables (dosages, contre-indications, précautions) et de ne pas oublier une prise quotidienne.  
Partant de ce constat, j’ai conçu et développé seul une application web responsive qui centralise les données sur les suppléments et offre un suivi personnalisé.

### Objectif
L’application **Vitam-in** permet à tout utilisateur, avec ou sans carence, de :
- rechercher un supplément par nom ou par symptôme,
- consulter des recommandations (quand le prendre, dosage, précautions),
- créer un compte privé pour enregistrer sa consommation, ajouter des notes personnelles et programmer des rappels quotidiens via Google Calendar,
- donner un avis public sur un supplément et échanger avec la communauté.

Un espace d’administration permet de gérer le catalogue des suppléments et de modérer les commentaires.

### Périmètre fonctionnel
**Fonctionnalités publiques (sans compte) :**
- Barre de recherche par nom de supplément ou par ressenti/symptôme
- Fiches détaillées des suppléments (indications, contre-indications, dosage)
- Consultation des avis et commentaires d’autres utilisateurs

**Fonctionnalités privées (utilisateur connecté) :**
- Inscription avec confirmation par e-mail (via Symfony Mailer)
- Connexion classique ou via Google OAuth 2.0
- Tableau de bord personnel listant les suppléments suivis (dosage, durée)
- Ajout de notes personnelles sur chaque prise (ressenti, effets)
- Activation de rappels quotidiens synchronisés avec Google Calendar
- Publication d’avis et commentaires, signalement de contenus inappropriés

**Fonctionnalités administrateur :**
- Gestion du catalogue de suppléments (ajout, modification, suppression)
- Modération des commentaires publics

### Technologies et outils
- **Framework** : Symfony (PHP) pour l’ensemble de l’application (front et back)
- **Styles** : Tailwind CSS pour une interface responsive et moderne
- **Base de données** : SQLite (via Doctrine)
- **Authentification** : système natif Symfony + Google OAuth 2.0
- **Emails** : Symfony Mailer avec Mailtrap (configuration Docker)
- **Environnement de développement** : Docker pour la base de données et le serveur mail, Visual Studio Code
- **Gestion de versions** : Git, dépôt GitHub, GitHub Projects avec une branche par issue et des commits atomiques

### Organisation du projet
Projet individuel mené avec une méthodologie agile légère :
- Découpage des fonctionnalités en issues GitHub
- Utilisation d’un tableau GitHub Projects (type Kanban)
- Développement itératif, chaque branche correspondant à une fonctionnalité
- Tests systématiques en local avant fusion

**Statut** : application entièrement fonctionnelle en environnement local. La procédure complète de lancement est documentée dans le fichier README.md (installation des dépendances, démarrage des containers Docker, exécution des migrations).

### Point fort mis en avant
L’intégration de **Google OAuth 2.0** et l’envoi d’un **email de confirmation** pour valider l’inscription illustrent une gestion sécurisée de l’authentification, respectueuse des bonnes pratiques de protection des données.

# DOSSIER DE PROJET – DWWM 2026

**Javier Archila Rojas**  
**Vitam‑in**  
**01/07/2026 – 06/08/2026**

---

## Sommaire

1. [Introduction et remerciements](#1-introduction-et-remerciements)
2. [Compétences du référentiel couvertes par le projet](#2-compétences-du-référentiel-couvertes-par-le-projet)
   - Activité type n°1 – Développer la partie front‑end
   - Activité type n°2 – Développer la partie back‑end
3. [Contexte & résumé du projet](#3-contexte--résumé-du-projet)
4. [Cahier des charges](#4-cahier-des-charges)
   - Objectifs
   - Cibles
   - Cas d’utilisation (Use Case)
   - Fonctionnalités
   - Choix de stack et d’architecture
   - Arborescence
   - Wireframes
5. [Contraintes rencontrées & évolutions potentielles](#5-contraintes-rencontrées--évolutions-potentielles)
   - MVP
   - Évolutions potentielles
   - Contraintes de temps
   - Autonomie
6. [Conception de la partie front‑end](#6-conception-de-la-partie-front-end)
   - Illustrations visuelles (web & mobile)
   - Extraits de code statique
   - Extraits de code dynamique
   - Logique des composants et services
7. [Conception de la partie back‑end](#7-conception-de-la-partie-back-end)
   - Mise en place de la base de données
   - Couche d’accès aux données (Doctrine)
   - Développement de la logique métier
8. [Sécurité serveur](#8-sécurité-serveur)
   - Authentification (session + Google OAuth)
   - Hashage des mots de passe (bcrypt)
   - Fichier d’environnement
9. [Documentation et possibilités de déploiement](#9-documentation-et-possibilités-de-déploiement)
10. [Conclusion](#10-conclusion)
11. [Annexes](#11-annexes)
    - MCD / MLD / MPD
    - Use Case
    - Extraits de code supplémentaires

---

## 1. Introduction et remerciements

Après plusieurs années passées à chercher des opportunités professionnelles dans des environnements exigeants physiquement, j’ai décidé de me tourner vers le développement web pour trouver un métier plus stimulant et en adéquation avec mes aspirations. La formation **DWWM** (Développeur Web et Web Mobile) que j’ai suivie en 2026 m’a permis d’acquérir les compétences nécessaires pour mener à bien un projet complet, de la conception au déploiement.

Le projet **Vitam‑in** est né de l’observation d’un besoin croissant : de nombreuses personnes consomment des compléments alimentaires sans vraiment savoir quand les prendre, à quel dosage, ni quelles sont les contre‑indications. L’idée était de créer une plateforme centralisant toutes ces informations utiles, tout en offrant un espace personnel pour suivre sa consommation et partager son expérience avec une communauté bienveillante.

Ce projet a été réalisé en autonomie complète, avec l’aide ponctuelle des formateurs et de mes camarades de promotion. Il m’a permis de mettre en pratique l’ensemble des compétences vues en formation, et de prendre conscience de l’importance d’une organisation rigoureuse et d’une architecture bien pensée.

Je tiens à remercier l’ensemble de l’équipe pédagogique pour son accompagnement, ainsi que mes collègues de promotion pour les échanges et les conseils partagés tout au long de cette aventure.

---

## 2. Compétences du référentiel couvertes par le projet

### Activité type n°1 : Développer la partie front‑end d’une application web sécurisée

- **Configurer son environnement de travail** – Installation de Symfony CLI, PHP, Composer, Tailwind, Twig, VS Code, Git.
- **Maquetter une application** – Réalisation de croquis et wireframes (Figma) pour organiser l’information.
- **Réaliser une interface utilisateur statique web responsive** – Utilisation de Tailwind CSS pour une adaptation mobile‑first (écrans PC, tablette, mobile).
- **Développer une interface utilisateur web dynamique** – Intégration de **Twig** pour le rendu côté serveur, composants **Live Component** pour la recherche et les interactions du tableau de bord sans rechargement de page.

### Activité type n°2 : Développer la partie back‑end d’une application web en intégrant les recommandations de sécurité

- **Créer une base de données** – Conception du MCD, MLD et MPD avec la méthode Merise ; implémentation sous SQLite (dev) / MySQL (prod) via Doctrine.
- **Développer les composants d’accès aux données** – Utilisation de l’ORM Doctrine pour les requêtes et les relations entre entités.
- **Développer des composants métier côté serveur** – Architecture MVC de Symfony avec contrôleurs, services, formulaires et validateurs.

---

## 3. Contexte & résumé du projet

**Vitam‑in** est une plateforme d’information et de suivi personnalisé autour des compléments vitaminiques en vente libre. Elle s’adresse à toute personne majeure souhaitant consommer ces compléments de manière éclairée.

L’application permet :
- de consulter des fiches détaillées pour chaque supplément (indications, posologie, contre‑indications) ;
- de rechercher par nom ou par ressenti ;
- de créer un compte personnel pour suivre ses prises (notes, dosage, durée) ;
- de programmer des rappels quotidiens synchronisés avec Google Calendar ;
- de partager son expérience via des commentaires publics et d’interagir avec la communauté (likes, signalement).

Le projet repose sur une architecture MVC (Modèle‑Vue‑Contrôleur) avec **Symfony**, un framework PHP robuste et bien documenté, associé à **Doctrine** pour la gestion de la base de données et **Tailwind CSS** pour le design responsive. L’authentification est assurée par session PHP classique et par **Google OAuth 2.0**.

---

## 4. Cahier des charges

### Objectifs

- Centraliser les informations essentielles sur les suppléments vitaminiques.
- Permettre à l’utilisateur de suivre sa consommation de manière personnalisée (notes, durée, dosage).
- Offrir un espace communautaire d’échange (commentaires, likes).
- Proposer des rappels quotidiens pour ne pas oublier ses prises.
- Assurer la sécurité des données personnelles et des échanges.

### Cibles

- **Âge** : 18 ans et plus
- **Profil** : Toute personne soucieuse de sa santé, consommant ou souhaitant consommer des compléments alimentaires en vente libre.
- **Revenus** : Tous niveaux
- **Localisation** : Sans restriction géographique (plateforme en ligne)

### Cas d’utilisation (Use Case)

Les acteurs principaux sont :
- **Visiteur** (non connecté)
- **Utilisateur connecté**
- **Administrateur**

Les cas d’usage majeurs sont :
- Consulter les fiches suppléments
- Rechercher un supplément
- S’inscrire / se connecter
- Gérer son tableau de bord (suivi des prises, notes personnelles)
- Publier des commentaires et des likes
- Modérer les commentaires (admin)
- Gérer le catalogue (admin)

Le diagramme complet est disponible en annexe.

### Fonctionnalités

**Côté public :**
- Barre de recherche (nom, symptôme/ressenti)
- Fiches détaillées des suppléments (indications, contre‑indications, dosage)
- Consultation des avis et commentaires

**Côté utilisateur connecté :**
- Inscription avec confirmation par e‑mail (Symfony Mailer)
- Connexion classique ou via Google OAuth 2.0
- Tableau de bord personnel (liste des suppléments suivis, notes)
- Ajout de notes personnelles (ressenti, effets)
- Activation de rappels quotidiens synchronisés avec Google Calendar
- Publication d’avis et commentaires
- Signalement de contenus inappropriés

**Côté administrateur :**
- Gestion complète du catalogue (ajout, modification, suppression)
- Modération des commentaires publics

### Choix de stack et d’architecture

J’ai opté pour une architecture **MVC** classique avec **Symfony** 6/7 pour les raisons suivantes :
- **Symfony** est un framework PHP mature, offrant une structure claire et une grande maintenabilité.
- **Twig** pour le templating côté serveur, ce qui facilite la séparation entre la logique et la présentation.
- **Doctrine ORM** pour interagir avec la base de données, avec une gestion simplifiée des relations et des migrations.
- **Tailwind CSS** pour un design responsive et moderne, en adoptant une approche **mobile‑first**.
- **SQLite** en développement (léger, sans serveur), **MySQL** en production via Docker.
- **Docker** pour conteneuriser l’ensemble (application, base de données, Mailtrap) et faciliter le déploiement.
- **Git** et **GitHub** pour le versioning, avec une méthodologie agile (epics, user stories, issues, branches).

### Arborescence
vitam-in/
├── docker/
│ ├── docker-compose.yml
│ └── .env
├── src/
│ ├── Controller/
│ ├── Entity/
│ ├── Repository/
│ ├── Service/
│ └── Form/
├── templates/
│ ├── base.html.twig
│ ├── home/
│ ├── supplement/
│ ├── dashboard/
│ └── admin/
├── public/
├── config/
├── .env.local
└── README.md


### Wireframes

J’ai commencé par des croquis à la main pour visualiser rapidement les idées, puis j’ai réalisé des wireframes sur **Figma** pour structurer l’information et définir les interfaces principales :

- Page d’accueil avec barre de recherche
- Page de résultats
- Fiche détaillée d’un supplément
- Dashboard personnel
- Page de profil
- Espace admin

Les wireframes sont disponibles en annexe.

---

## 5. Contraintes rencontrées & évolutions potentielles

### Minimum Viable Product (MVP)

Le MVP retenu pour Vitam‑in comprend :
- La recherche de suppléments (nom, symptôme)
- Les fiches détaillées (indications, contre‑indications, dosage)
- L’inscription et la connexion (email + Google OAuth)
- Le tableau de bord personnel (suivi des prises, notes)
- La publication de commentaires publics
- Les rappels quotidiens (Google Calendar)

### Évolutions potentielles

Bien que le projet soit complet, plusieurs axes d’amélioration sont envisageables :
- Ajout de **notifications push** pour les rappels
- **Gamification** (badges, progression)
- **Export** des données de suivi (PDF, CSV)
- **Intégration** avec des montres connectées pour suivre les prises automatiquement
- **Multi‑langues** pour élargir l’audience

### Contraintes de temps

La durée impartie (environ 5 semaines) était relativement courte pour un projet aussi riche. La principale difficulté a été de :
- Rassembler et organiser les informations sur les suppléments (fiabilité des sources).
- Concevoir une API simple mais extensible.
- Gérer l’authentification sociale (Google OAuth) et la synchronisation avec Google Calendar.

J’ai dû prioriser les fonctionnalités essentielles (MVP) et m’appuyer sur la documentation officielle de Symfony pour résoudre les problèmes rencontrés.

### Autonomie

Réaliser ce projet seul m’a obligé à endosser tous les rôles : chef de projet, développeur front‑end, développeur back‑end, intégrateur, testeur. Cela m’a permis de prendre conscience de l’importance d’une bonne organisation, d’un suivi rigoureux des issues GitHub et d’une communication claire pour avancer efficacement.

---

## 6. Conception de la partie front‑end

### Illustrations visuelles (web & mobile)

Le design est minimaliste, avec une dominante de bleu clair pour les titres et un gris sombre pour le dashboard. L’ensemble est responsive grâce à Tailwind.

- **Page d’accueil** – Barre de recherche centrale, catégories de suppléments.
- **Page résultat** – Liste des suppléments avec filtres.
- **Page fiche supplément** – Informations détaillées, bouton “Ajouter à mon suivi”.
- **Dashboard** – Vue des suppléments suivis, calendrier des prises, notes personnelles.
- **Espace admin** – Gestion des suppléments et modération des commentaires.

> *(Des captures d’écran sont fournies en annexe.)*

### Extraits de code statique

Exemple de la barre de recherche (Twig) :

```twig
<div class="search-container">
    {{ form_start(searchForm) }}
        {{ form_widget(searchForm.query, { 'attr': { 'placeholder': 'Rechercher un supplément...' } }) }}
        <button type="submit" class="btn-search">
            <i class="fas fa-search"></i>
        </button>
    {{ form_end(searchForm) }}
</div>

La page d’accueil affiche également des cartes de suppléments populaires, statiques mais enrichies dynamiquement via le contrôleur.
Extraits de code dynamique

Pour la recherche en temps réel, j’ai utilisé un LiveComponent de Symfony :
twig

{{ component('SearchLive', { query: searchQuery }) }}

Le composant Live gère la mise à jour des résultats sans rechargement :
php

// SearchLive.php
#[LiveComponent]
class SearchLive
{
    #[LiveProp]
    public string $query = '';

    public function getResults(): array
    {
        return $this->supplementRepository->search($this->query);
    }
}

Logique des composants et services

Le tableau de bord utilise plusieurs services Symfony pour :

    Récupérer les suppléments suivis par l’utilisateur.

    Ajouter/modifier des notes personnelles.

    Synchroniser les rappels avec Google Calendar.

php

class DashboardService
{
    public function getUserSupplements(User $user): array
    {
        return $this->em->getRepository(UserSupplement::class)->findByUser($user);
    }

    public function addNote(UserSupplement $us, string $content): void
    {
        $note = new Note();
        $note->setUserSupplement($us);
        $note->setContent($content);
        $this->em->persist($note);
        $this->em->flush();
    }
}

7. Conception de la partie back‑end
Mise en place de la base de données
Choix du SGBD

Pour le développement, j’ai utilisé SQLite pour sa légèreté et sa simplicité d’installation. 
En production, j’ai configuré MySQL via Docker, ce qui permet une meilleure gestion des performances
 et de la sécurité. Ce choix est facilité par la flexibilité de Doctrine, qui supporte plusieurs moteurs de base de données.
 
Conception du MCD

J’ai suivi la méthode Merise pour modéliser les données :

    User (id, email, password, roles, google_id, ...)

    Supplement (id, name, description, dosage, indications, contre_indications, ...)

    Category (id, name)

    Benefit (id, description) – bénéfices attendus

    UserSupplement (id, user_id, supplement_id, start_date, end_date, daily_dosage, ...)

    Note (id, user_supplement_id, content, created_at)

    Comment (id, user_id, supplement_id, content, created_at, parent_id, ...)

    Like (id, user_id, comment_id)

    Reminder (id, user_supplement_id, time, google_event_id, ...)

    Report (id, comment_id, user_id, reason, status)

Les relations principales :

    Un User peut avoir plusieurs UserSupplement.

    Un Supplement peut avoir plusieurs UserSupplement et plusieurs Comment.

    Un UserSupplement peut avoir plusieurs Note et un Reminder.

    Un Comment peut avoir plusieurs Like et des réponses (auto‑référencement).

Conception du MLD et MPD

J’ai formalisé le MLD (Modèle Logique de Données) avec les tables, clés primaires et étrangères, puis j’ai généré le MPD (Modèle Physique) en créant les entités Doctrine via la console :
bash

php bin/console make:entity

Les migrations sont gérées automatiquement :
bash

php bin/console doctrine:migrations:migrate

Couche d’accès aux données (Doctrine)

Doctrine ORM permet d’interagir avec la base de données en PHP pur. Voici un exemple de requête pour récupérer les suppléments suivis par un utilisateur :
php

// UserSupplementRepository.php
public function findActiveByUser(User $user): array
{
    return $this->createQueryBuilder('us')
        ->where('us.user = :user')
        ->andWhere('us.endDate >= :now')
        ->setParameter('user', $user)
        ->setParameter('now', new \DateTime())
        ->getQuery()
        ->getResult();
}

Développement de la logique métier

L’architecture MVC de Symfony sépare clairement les responsabilités :

    Contrôleurs – Reçoivent les requêtes HTTP, appellent les services et rendent les vues.

    Services – Contiennent la logique métier (gestion du dashboard, synchronisation Google, envoi d’emails).

    Repositories – Interrogent la base de données via Doctrine.

    Formulaires – Gèrent la validation et le rendu des formulaires.

Exemple de contrôleur pour le dashboard :
php

#[Route('/dashboard', name: 'dashboard')]
public function index(Request $request, DashboardService $dashboardService): Response
{
    $user = $this->getUser();
    $supplements = $dashboardService->getUserSupplements($user);
    return $this->render('dashboard/index.html.twig', [
        'supplements' => $supplements,
    ]);
}

8. Sécurité serveur
Authentification (session + Google OAuth)

L’authentification est gérée par le composant Security de Symfony :

    Connexion classique – formulaire avec vérification des identifiants.

    Google OAuth 2.0 – intégration via le bundle knpu/oauth2-client pour permettre la connexion avec un compte Google.

Les routes sont protégées par le firewall et le système de voters :
yaml

access_control:
    - { path: ^/dashboard, roles: ROLE_USER }
    - { path: ^/admin, roles: ROLE_ADMIN }

Hashage des mots de passe (bcrypt)

Les mots de passe sont hashés avec bcrypt via le composant security de Symfony avant d’être stockés en base.
yaml

# config/packages/security.yaml
security:
    encoders:
        App\Entity\User:
            algorithm: bcrypt

Fichier d’environnement

Toutes les variables sensibles (clés Google OAuth, base de données, Mailtrap, etc.) sont stockées dans le fichier .env.local (exclu du dépôt Git) :
env

DATABASE_URL=mysql://user:pass@db:3306/vitam_in
GOOGLE_CLIENT_ID=xxxxx
GOOGLE_CLIENT_SECRET=yyyyy
MAILER_DSN=smtp://mailtrap:2525

9. Documentation et possibilités de déploiement

Bien que l’application ne soit pas déployée en production, j’ai préparé une documentation pour faciliter son déploiement.
Déploiement avec Docker

Un fichier docker-compose.yml permet de lancer l’application, la base de données MySQL et Mailtrap :
yaml

version: '3'
services:
  db:
    image: mysql:8
    environment:
      MYSQL_DATABASE: vitam_in
      MYSQL_USER: user
      MYSQL_PASSWORD: pass
      MYSQL_ROOT_PASSWORD: root
    ports:
      - "3306:3306"
    volumes:
      - db_data:/var/lib/mysql
  app:
    build: .
    ports:
      - "8000:8000"
    depends_on:
      - db
    environment:
      DATABASE_URL: mysql://user:pass@db:3306/vitam_in
  mailtrap:
    image: mailtrap/mailtrap
    ports:
      - "2525:2525"
volumes:
  db_data:

Étapes d’installation (manuel)

    Cloner le dépôt.

    Installer les dépendances : composer install

    Copier .env et configurer .env.local.

    Créer la base de données et exécuter les migrations.

    Lancer le serveur Symfony : php bin/console server:run

10. Conclusion

Le projet Vitam‑in m’a permis de mettre en œuvre l’ensemble des compétences acquises lors de la formation DWWM, de la conception à la réalisation technique. Il répond à un besoin réel en offrant une plateforme claire, sécurisée et interactive pour aider les utilisateurs à mieux consommer les compléments vitaminiques.

Les défis rencontrés – recherche d’informations, intégration d’OAuth, synchronisation avec Google Calendar – m’ont beaucoup appris sur la gestion d’un projet web complet. J’ai pris conscience de l’importance d’une bonne organisation, de l’utilisation de méthodologies agiles (GitHub Issues, branches) et de la veille documentaire.

Ce projet constitue une base solide que je pourrai enrichir à l’avenir (notifications, gamification, export de données). Il m’a également conforté dans mon choix de poursuivre dans le développement web, en visant toujours plus de qualité et d’innovation.
11. Annexes

    Use Case – Diagramme des acteurs et cas d’utilisation (PDF en annexe).

    MCD – Modèle Conceptuel de Données.

    MLD / MPD – Modèles Logique et Physique.

    Wireframes – Croquis et maquettes Figma.

    Captures d’écran – Pages principales (accueil, recherche, dashboard, admin).

    Extraits de code – Contrôleurs, services, entités, formulaires, LiveComponents.

    Configuration Docker – Fichiers Dockerfile et docker-compose.yml.