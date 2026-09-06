# VITAM-IN

## Resume

Destinée à toute personne, avec ou sans carences en vitamines, souhaitant consommer des suppléments de façon contrôlée pour en tirer des bienfaits, VITAM-IN réunit et centralise toute l’information utile sur les principaux suppléments vitaminiques disponibles en vente libre.

- quand il est recommandé de prendre un supplément 
- quand il n’est pas recommandé de le prendre 
- le dosage suggéré 
- les contre-indications et précautions. 

Elle propose également un compte personnel et privé, où l’utilisateur peut tenir un registre et suivre les bénéfices ressentis ou non au fil de sa consommation, avec la possibilité d’ajouter des notes personnalisées et de programmer des rappels quotidiens pour ne pas oublier de prendre ses suppléments.

---

## Tecnologías utilizadas

- **Backend**: Symfony 8.1 (PHP 8.4)
- **Bdd**: MySQL 
- **Conteneur**: Docker y Docker Compose
- **Env**: Variables d'environnement gérées avec `.env.local`

---

## Requisitos previos

Antes de comenzar, asegúrate de tener instalado en tu sistema:

- [Docker](https://www.docker.com/get-started) 
- [Docker Compose](https://docs.docker.com/compose/install/) 
- Git (Facultatif, pour cloner le dépôt)

---

## Installation 

Suivez ces étapes pour configurer l'application dans votre environnement local.

### 1. Clonez le dépôt (ou téléchargez les fichiers)

```bash
git clone <url-del-repositorio>
cd vitam-in
```
### 2. Configurer les variables d'environnement
Modifiez le fichier .env.local avec les valeurs correctes pour votre base de données et les autres paramètres.
# .env.local
DATABASE_URL="mysql://usuario:contraseña@database:3306/vitamin?serverVersion=8.0"
APP_ENV=dev
APP_SECRET=tu_secreto

### 3. Lancer les conteneurs
```bash
docker-compose up -d --build
```

### 4. Installer les dépendances de Composer
```bash
docker compose exec vitam-in-app composer install
```
(Remplacez vitam-in-app par le nom réel de votre conteneur s'il est différent ; il s'agit généralement de app).

## 5. Créez la base de données et exécutez les migrations.
```bash
docker exec vitam-in-app php bin/console doctrine:database:create --if-not-exists
docker exec vitam-in-app php bin/console doctrine:migrations:migrate
```

## 6. Charger les données de test (facultatif)

```bash
docker exec vitam-in-app php bin/console doctrine:fixtures:load
```

## 7. Accédez à l'application

http://localhost:8080

---

## Utilisation de l'application

### Inscription et authentification

Les utilisateurs peuvent s'inscrire avec une adresse e-mail et un mot de passe ou avec Google Aouth.

L'authentification est gérée par le système de sécurité Symfony.

### Fonctionnalités principales

Catalogue de supplement : Liste de vitamines et de compléments alimentaires avec des informations détaillées (posologie, présentation, bienfaits, contre-indications).

Journal de consommation : Les utilisateurs peuvent ajouter des entrées indiquant le supplement la dose et l'heure de prise.

Suivi des bienfaits : Chaque entrée permet aux utilisateurs d'indiquer s'ils ont constaté des bienfaits ou des effets indésirables et d'ajouter des notes.

Rappels quotidiens : Les utilisateurs peuvent programmer des notifications via Google Calendare pour leur rappeler de prendre leurs compléments.

### Rôles

RÔLE_USER : Utilisateur enregistré (accès à son espace personnel).

RÔLE_ADMINISTRATEUR : Administrateur ayant accès au panneau de gestion des compléments et des utilisateurs.



