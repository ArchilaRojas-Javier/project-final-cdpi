## 🎯 SYNTHÈSE DU PROJET

**Nom du projet** : Vitam-in  
**Candidat** : [Ton prénom et nom]  
**Date** : [Date de rédaction]

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