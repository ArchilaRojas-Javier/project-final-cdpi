


# EPICS & USER STORIES

## Lexiques

- *Supplément* : 
Dans le cadre de l’application, un supplément désigne un produit disponible en vente libre, destiné à compléter l’alimentation courante. Il se présente sous forme de gélules, comprimés, poudres ou liquides, et contient un ou plusieurs nutriments (vitamines, minéraux, acides aminés, extraits de plantes, etc.) dans un but de maintien du bien-être.


## EPIC 1 - Recherche de supplément

- **User story 1:** En tant que visiteur, je veux accéder aux informations d’un supplément: posologie, précautions, moment de prise en tapant son nom dans une barre de recherche, afin d’obtenir tous les détails nécessaires pour le consommer correctement.
    - **CA 1 :** Étant donné que le visiteur est sur la page de recherche,
quand il saisit le nom exact d’un supplément existant et valide la recherche,
alors le filtrage affiche la fiche détaillée de ce supplément avec : sa posologie, ses précautions et les recommandations de prise.
    - **CA 2 :** Étant donné que le visiteur saisit un nom qui ne correspond à aucun supplément enregistré,
quand il lance la recherche,
alors le système affiche un message informatif du type `Aucun supplément trouvé pour ce terme `.
    - **CA 3 :** Étant donné que le visiteur n’a rien écrit dans le champ de recherche,
quand il tente de lancer la recherche,
alors le système ne déclenche pas la recherche et affiche un message d’erreur indiquant qu’un terme doit être saisi.
    - **CA 4 :** Étant donné que le visiteur écrit le nom du supplément en majuscules, en minuscules ou en mélangeant les deux,
quand il lance la recherche,
alors le système ignore la casse et retourne la fiche du supplément correspondant.
    - **CA 5 :** Étant donné que le visiteur tape seulement une partie du nom,
quand il lance la recherche,
alors le système affiche une liste de tous les suppléments dont le nom contient ces caractères, permettant au visiteur de choisir celui qu’il souhaite.
    - **CA 6 :** Étant donné que le visiteur saisit des caractères spéciaux ou un script 
     dans le champ de recherche, 
     quand la recherche est exécutée,
alors le système ne l’interprète pas comme du code, affiche un message d’erreur et traite ces caractères comme du texte normal sans risque de sécurité.

- **User story 2:** En tant que visiteur, je veux obtenir des suggestions de suppléments en fonction du bienfait recherché afin de choisir un suppléments.
    - **CA 1 :** Étant donné que le visiteur souhaite obtenir une suggestion,
quand il écrit un bienfait reconnu et valide,
alors le système affiche une liste cliquable de suppléments liés à ce bienfait, chaque élément menant à la fiche détaillée correspondante.
    - **CA 2 :** Étant donné que le visiteur saisit un bienfait qui n’est associé à aucun supplément en base,
quand il lance la recherche,
alors le système affiche le message `Aucun supplément trouvé pour ce bienfait`.

**NOTE :** Les critères de validation de la barre de recherche (champ vide, caractères spéciaux, insensibilité à la casse) décrits dans la user story 1 s’appliquent également à cette fonctionnalité.
    
## EPIC 2 - Inscription et authentification

- **User story 3:** En tant que visiteur, je veux créer un compte personnel en fournissant une adresse email et un mot de passe, afin d’accéder aux fonctionnalités privées de suivi et de rappels.
    - **CA 1 :** Étant donné que le visiteur est sur le formulaire d’inscription,
quand il saisit une adresse email valide non utilisée et un mot de passe d’au moins 8 caractères alphanumériques, puis valide,
alors le système chiffré le mot de passe avec bcrypt, crée le compte, connecte automatiquement l’utilisateur et le redirige vers le tableau de bord avec un message de confirmation ` Votre compte a été créé avec succès`.
    - **CA 2 :** Étant donné que le visiteur saisit une adresse email déjà associée à un compte existant,
quand il soumet le formulaire,
alors le système refuse l’inscription et affiche un message d’erreur ` Cette adresse email est déjà utilisée `.
    - **CA 3 :** Étant donné que le visiteur saisit un mot de passe de moins de 8 caractères,
quand il soumet le formulaire,
alors le système refuse l’inscription et demande un mot de passe d’au moins 8 caractères.
    - **CA 4 :** Étant donné que le visiteur saisit un mot de passe sans aucun chiffre ni lettre,
quand il soumet le formulaire,
alors le système refuse et indique que le mot de passe doit contenir au moins un chiffre et une lettre.
    - **CA 5 :** Étant donné que le visiteur saisit une adresse email sans format valide,
quand il soumet le formulaire,
alors un message d’erreur explicite lui demande de saisir une adresse email correcte.
    - **CA 6 :** Étant donné que le visiteur insère du code malveillant dans les champs email ou mot de passe,
quand il soumet le formulaire,
alors le code n’est pas exécuté, et le système affiche un message d’erreur générique ` Saisie invalide `.
    - **CA 7 :** Étant donné que le visiteur remplit le champ "Confirmer le mot de passe",
quand les deux mots de passe ne correspondent pas,
alors le système bloque l’envoi et affiche `Les mots de passe ne correspondent pas`

- **User story 4:** En tant qu’utilisateur inscrit, je veux me connecter à mon compte avec mes identifiants: email et mot de passe, afin de retrouver mon historique de consommation et mes notes.
    - **CA 1 :** Étant donné que l’utilisateur est sur la page de connexion,
quand il saisit son email et son mot de passe valides,
alors le système vérifie l’email, compare le mot de passe haché, génère un token JWT et redirige vers le tableau de bord.
    - **CA 2 :** Étant donné que l’email saisi n’existe pas en base,
quand l’utilisateur tente de se connecter,
alors un message d’erreur `Email ou mot de passe incorrect`  s’affiche.
    - **CA 3 :** Étant donné que l’email existe mais que le mot de passe est incorrect,
quand la tentative de connexion a lieu,
alors le système refuse l’accès et affiche message générique `Email ou mot de passe incorrect `.
    - **CA 4 :** Étant donné que l’utilisateur laisse les champs email ou mot de passe vides,
quand il soumet le formulaire,
alors un message d’erreur lui demande de remplir tous les champs.

**NOTE:** Tous les mots de passe utilisateur sont hachés avec l'algorithme bcrypt côté serveur avant d'être stockés dans la base de données. Lors de la connexion, le système compare le mot de passe saisi au hash enregistré.

## EPIC 3 - Espace membre

- **User story 8:**
    - En tant qu’utilisateur connecté, je veux accéder à un tableau de bord résumant mes prises du jour: ce que j’ai déjà pris et ce qu’il me reste à prendre, et, pour chaque supplément en cours, le nombre de jours restants si j’ai défini une durée, afin d’avoir une vision claire et rapide de mon suivi quotidien.
    - **CA 1 :** kjrfkjf
    - **CA 1 :** kjrfkjf
    - **CA 1 :** kjrfkjf

- **User story 9:**
    - En tant qu’utilisateur connecté, je veux pouvoir activer un rappel quotidien pour chacun de mes suppléments, en choisissant une heure de notification, afin de ne pas oublier mes prises et d’adapter les alertes à mes besoins. Je peux également le désactiver à tout moment.
    - **CA 1 :** kjrfkjf
    - **CA 1 :** kjrfkjf
    - **CA 1 :** kjrfkjf

- **User story 3:**
    - En tant qu’utilisateur, Je veux disposer d’un historique de mes prises de suppléments pour suivre ma consommation sur le long terme.
    - **CA 1 :** kjrfkjf
    - **CA 1 :** kjrfkjf
    - **CA 1 :** kjrfkjf

- **User story 4:**
    - En tant qu’utilisateur, je veux prendre note des effets constatés après avoir consommé un supplément afin de documenter mon expérience.
    - **CA 1 :** kjrfkjf
    - **CA 1 :** kjrfkjf
    - **CA 1 :** kjrfkjf

- **User story 5:**
    - En tant qu’utilisateur, je veux partager mon expérience sous forme de commentaire pour aider les autres utilisateurs qui cherchent de l’information.
    - **CA 1 :** kjrfkjf
    - **CA 1 :** kjrfkjf
    - **CA 1 :** kjrfkjf

## EPIC 2 - Dahsboard Vendor