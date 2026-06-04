


# EPICS & USER STORIES

## Lexiques

- *Supplément* : 
Dans le cadre de l’application, un supplément désigne un produit disponible en vente libre, destiné à compléter l’alimentation courante. Il se présente sous forme de gélules, comprimés, poudres ou liquides, et contient un ou plusieurs nutriments (vitamines, minéraux, acides aminés, extraits de plantes, etc.) dans un but de maintien du bien-être.


## EPIC 1 - Recherche de supplément

- **User story 1:** En tant que visiteur, je veux accéder aux informations d’un supplément: posologie, précautions, moment de prise en tapant son nom dans une barre de recherche, afin d’obtenir tous les détails nécessaires pour le consommer correctement.
    
    - **C.A 1:** Étant donné que le visiteur est sur la page de recherche,
    quand il saisit le nom exact d’un supplément existant et valide la recherche,   
    alors le systéme affiche la fiche détaillée de ce supplément avec : sa posologie, ses précautions et les recommandations de prise.
    
    - **C.A 2 :** Étant donné que le visiteur saisit un nom qui ne correspond à aucun supplément enregistré,
    quand il lance la recherche,
    alors le système affiche un message informatif du type `Aucun supplément trouvé pour ce terme `.
    
    - **C.A 3 :** Étant donné que le visiteur n’a rien écrit dans le champ de recherche,
    quand il tente de lancer la recherche,
    alors le système ne déclenche pas la recherche et affiche un message d’erreur indiquant qu’un terme doit être saisi.
    
    - **C.A 4 :** Étant donné que le visiteur écrit le nom du supplément en majuscules, en minuscules ou en mélangeant les deux,
    quand il lance la recherche,
    alors le système ignore la casse et retourne la fiche du supplément         correspondant.
    
    - **C.A 5 :** Étant donné que le visiteur tape seulement une partie du nom,
    quand il lance la recherche,
    alors le système affiche une liste de tous les suppléments dont le nom contient ces caractères, permettant au visiteur de choisir celui qu’il souhaite.
    
    - **C.A 6 :** Étant donné que le visiteur saisit des caractères spéciaux ou un script dans le champ de recherche, 
    quand la recherche est exécutée,
    alors le système ne l’interprète pas comme du code, affiche un message d’erreur et traite ces caractères comme du texte normal sans risque de sécurité.


- **User story 2:** En tant que visiteur, je veux obtenir des suggestions de suppléments en fonction du bienfait recherché afin de choisir un supplément.
    
    - **C.A 1 :** Étant donné que le visiteur souhaite obtenir une suggestion,
    quand il écrit un bienfait reconnu et valide,
    alors le système affiche une liste cliquable de suppléments liés à ce bienfait, chaque élément menant à la fiche détaillée correspondante.
    
    - **C.A 2 :** Étant donné que le visiteur saisit un bienfait qui n’est associé à aucun supplément en base,
    quand il lance la recherche,
    alors le système affiche le message `Aucun supplément trouvé pour ce bienfait`.

**NOTE :** Les critères de validation de la barre de recherche (champ vide, caractères spéciaux, insensibilité à la casse) décrits dans la user story 1 s’appliquent également à cette fonctionnalité.
    
## EPIC 2 - Inscription et authentification


- **User story 3:** En tant que visiteur, je veux créer un compte personnel en fournissant une adresse email et un mot de passe, afin d’accéder aux fonctionnalités privées de suivi et de rappels.
    
    - **C.A 1 :** Étant donné que le visiteur est sur le formulaire d’inscription,
    quand il saisit une adresse email valide non utilisée et un mot de passe d’au moins 8 caractères alphanumériques, puis valide,
    alors le système chiffre le mot de passe avec bcrypt, crée le compte, connecte automatiquement l’utilisateur et le redirige vers le tableau de bord avec un message de confirmation ` Votre compte a été créé avec succès`.
    
    - **C.A 2 :** Étant donné que le visiteur saisit une adresse email déjà associée à un compte existant,
    quand il soumet le formulaire,
    alors le système refuse l’inscription et affiche le message d’erreur ` Cette adresse email est déjà utilisée `.
    
    - **C.A 3 :** Étant donné que le visiteur saisit un mot de passe de moins de 8 caractères,
    quand il soumet le formulaire,
    alors le système refuse l’inscription et demande un mot de passe d’au moins 8 caractères.
    
    - **C.A 4 :** Étant donné que le visiteur saisit un mot de passe sans aucun chiffre ni lettre,
    quand il soumet le formulaire,
    alors le système refuse et indique que le mot de passe doit contenir au moins un chiffre et une lettre.
    
    - **C.A 5 :** Étant donné que le visiteur saisit une adresse email sans format valide,
    quand il soumet le formulaire,
    alors un message d’erreur explicite lui demande de saisir une adresse email correcte.
    
    - **C.A 6 :** Étant donné que le visiteur insère du code malveillant dans les champs email ou mot de passe,
    quand il soumet le formulaire,
    alors le code n’est pas exécuté, et le système affiche le message d’erreur générique ` Saisie invalide `.
    
    - **C.A 7 :** Étant donné que le visiteur remplit le champ "Confirmer le mot de passe",
    quand les deux mots de passe ne correspondent pas,
    alors le système bloque l’envoi et affiche le message d'erreur `Les mots de passe ne correspondent pas`


- **User story 4:** En tant qu’utilisateur inscrit, je veux me connecter à mon compte avec mes identifiants: email et mot de passe, afin de retrouver mon historique de consommation et mes notes.
    
    - **C.A 1 :** Étant donné que l’utilisateur est sur la page de connexion,
    quand il saisit son email et son mot de passe valides,
    alors le système vérifie l’email, compare le mot de passe haché, génère un token JWT et redirige vers le tableau de bord.
    
    - **C.A 2 :** Étant donné que l’email saisi n’existe pas en base,
    quand l’utilisateur tente de se connecter,
    alors le message d’erreur `Email ou mot de passe incorrect`  s’affiche.
    
    - **C.A 3 :** Étant donné que l’email existe mais que le mot de passe est incorrect,
    quand la tentative de connexion a lieu,
    alors le système refuse l’accès et affiche le message générique `Email ou mot de passe incorrect `.
    
    - **C.A 4 :** Étant donné que l’utilisateur laisse les champs email ou mot de passe vides,
    quand il soumet le formulaire,
    alors un message d’erreur lui demande de remplir tous les champs.

- **User story 5:** En tant que visiteur, je veux pouvoir créer un compte ou me connecter en utilisant mon compte Google, afin de simplifier l’inscription et d’autoriser l’application à gérer mes rappels dans Google Calendar.

    - **C.A 1 :** Étant donné que le visiteur clique sur "Se connecter avec Google",
    quand il accepte les autorisations demandées,
    alors un compte utilisateur est créé ou lié s’il existe déjà avec le même email et il est redirigé vers le tableau de bord connecté.

    - **C.A 2 :** Étant donné que le visiteur lance la connexion Google,
    quand il refuse les autorisations,
    alors l’application affiche un message indiquant que l’accès au calendrier est nécessaire pour les rappels, et propose de réessayer ou de s’inscrire par email.

    - **C.A 3 :** Étant donné que l'utilisateur connecté via Google ferme sa session,
    quand il se déconnecte,
    alors l'application ferme sa session locale sans révoquer l'accès à Google Calendar, ce qui permet aux rappels existants de continuer à fonctionner normalement.

**NOTE:** Tous les mots de passe utilisateur sont hachés avec l'algorithme bcrypt côté serveur avant d'être stockés dans la base de données. Lors de la connexion, le système compare le mot de passe saisi au hash enregistré.
L’authentification utilise OAuth 2.0. Les scopes demandés sont email, profile et https://www.googleapis.com/auth/calendar.events. Les tokens sont stockés de manière sécurisée côté serveur et ne sont jamais exposés au client.
La révocation des tokens OAuth n'est effectuée que si l'utilisateur choisit explicitement de dissocier son compte Google, une fonctionnalité qui peut être ajoutée dans une version ultérieure.


## EPIC 3 - Espace membre

- **User story 6:** En tant qu’utilisateur connecté, je veux accéder à un tableau de bord résumant pour chaque supplément en cours, le nombre de jours restants et la dose journaliére, afin d’avoir une vision claire et rapide de mon suivi quotidien.
    
    - **C.A 1 :** Étant donné que l’utilisateur connecté suit au moins un supplément avec une durée définie,
    quand il accède au tableau de bord,
    alors il voit chaque supplément, la dose journalière et le nombre de jours restants.
    
    - **C.A 2 :** Étant donné que l’utilisateur n’a aucun supplément dans son suivi actif,
    quand il arrive sur le tableau de bord,
    alors un message l’informe : ` Vous n’avez aucun suivi en cours. Ajoutez un supplément pour commencer.`
    
- **User story 7:** En tant qu'utilisateur connecté, lorsque j'ajoute un supplément à mon suivi, je peux personnaliser la durée, la dose, l'heure et la consigne. Si j'ai lié mon compte Google, je peux également activer des rappels quotidiens dans Google Calendar pour recevoir une notification sur mon téléphone avec l'heure, la dose et la consigne. Je peux modifier ou désactiver ces rappels à tout moment.

    - **C.A 1 :** Étant donné que l'utilisateur a cliqué sur "Ajouter à mon suivi",
    quand le formulaire s'affiche,
    alors les champs suivants sont pré-remplis à partir des données recommandées du supplément : durée, dose, heure de prise, consigne, et l'utilisateur peut les modifier avant validation.

    - **C.A 2 :** Étant donné que l'utilisateur connecté est sur la fiche d'un supplément et clique sur "Ajouter à mon suivi",
    et valide,
    alors le supplément est ajouté à son suivi avec les valeurs saisies, et apparaît dans le tableau de bord.

    - **C.A 3 :** Étant donné que l'utilisateur a coché "Activer les rappels Google Calendar" et a configuré les champs,
    quand il valide l'ajout,
    alors un événement récurrent quotidien est créé dans son Google Calendar principal avec :

    Titre : "Prendre [nom du supplément] – [dose]",

    Heure de début : celle choisie,

    Description : [la consigne],

    Récurrence : du jour de début jusqu'à la date de fin

    Rappel par notification standard Google
    et un message de confirmation  "Vos rappels ont été programmés dans Google Calendar" s'affiche.

    - **C.A 4 :** Étant donné que l'utilisateur souhaite arrêter les rappels,
    quand il désactive l'option de rappel pour ce supplément ou supprime le supplément de son suivi,
    alors l'événement récurrent est immédiatement supprimé de son Google Calendar.

    - **C.A 5 :** Étant donné que l'utilisateur n'a pas encore lié son compte Google ou a révoqué l'accès au calendrier,
    quand il essaie d'activer les rappels,
    alors le système lui propose de se connecter avec Google et d'accorder la permission "Gérer vos calendriers". Sans cette autorisation, l'option de rappel reste grisée.

    - **C.A 6 :** Étant donné que les données envoyées à Google Calendar (nom du supplément, consigne) proviennent de la base ou de la saisie utilisateur,    
    quand l'événement est créé,
    alors toutes les chaînes sont échappées pour éviter toute injection, et seuls les champs nécessaires sont transmis.
    
- **User story 8:** En tant qu’utilisateur connecté, je veux prendre note des effets constatés après avoir consommé un supplément afin de documenter mon expérience.

    - **C.A 1 :** Étant donné que l’utilisateur consulte la fiche d’un supplément qu’il suit ou son suivi,
    quand il rédige une note et l’enregistre,
    alors la note est associée à son compte et au supplément, avec la date de création, et est consultable dans son espace.

    - **C.A 2 :** Étant donné que l’utilisateur a déjà rédigé une ou plusieurs notes,
    quand il accède à la section « Mes notes » ou à l’historique du supplément,
    alors il voit la liste de ses notes avec leur date, dans l’ordre antéchronologique.

    - **C.A 3 :** Étant donné que l’utilisateur souhaite corriger une note,
    quand il clique sur <button>Modifier</button>  ou  <button>Supprimer</button>,
    alors les modifications sont enregistrées ou la note est supprimée et un message de confirmation s'affiche.

    - **C.A 4 :** Étant donné que l’utilisateur saisit des caractères spéciaux ou du code malveillant dans le champ note, quand il enregistre, alors le système échappe ces caractères et les traite comme du texte normal, empêchant ainsi toute exécution de code malveillant.


- **User story 9:** En tant qu’utilisateur, Je veux disposer d’un historique de mes prises de suppléments pour suivre ma consommation sur le long terme.

    - **C.A 1 :** Étant donné que l’utilisateur a ajouté un ou plusieurs suppléments à son suivi,
    quand il accède à son historique,
    alors il voit une liste contenant pour chaque supplément : son nom, la date de début de la prise, la date de fin si elle est terminée, ou la mention En cours, et le nombre de notes associées.

    - **C.A 2 :** Étant donné que l’utilisateur sélectionne un supplément dans la liste,
    quand il clique dessus,
    alors il peut voir le détail complet : dates de début et de fin, durée totale calculée en jours, et la liste complète de ses notes personnelles pour cette supplémentation avec leur date.

    - **C.A 3 :** Étant donné que l’utilisateur n’a jamais enregistré de supplément dans son suivi,
    quand il accède à l’historique,
    alors le système affiche un message informatif : `Vous n’avez pas encore de supplémentation enregistrée.`

- **User story 10:** En tant qu’utilisateur, je veux partager mon expérience sous forme de commentaire pour aider les autres utilisateurs qui cherchent de l’information.

    - **C.A 1 :** Étant donné que l’utilisateur est sur la fiche d’un supplément,
    quand il écrit un commentaire et le publie,
    alors le commentaire apparaît dans la liste publique, avec son prénom ou pseudo et la date.

    - **C.A 2 :** Étant donné que n’importe quel visiteur consulte la fiche détaillée d'un supplément,
    quand il descend à la section commentaire, 
    alors il voit tous les commentaires approuvés, classés du plus récent au plus ancien.

    - **C.A 3 :** Étant donné que l’utilisateur publie un commentaire,
    quand le commentaire contient des caractères interdits ou un script,
    alors le système le rejette ou l’échappe, et le contenu dangereux n’est pas exécuté.

    - **C.A 4 :** Étant donné que l’auteur d’un commentaire le consulte,
    quand il clique sur <button>Supprimer</button>,
    alors le commentaire est retiré de la fiche.

- **User story Bonus:** En tant qu'utilisateur connecté, je veux accéder à mon profil personnel pour y renseigner ou consulter mes informations de base: nom, âge, pseudo, photo/avatar, afin de personnaliser mon expérience dans l'application.

    - **C.A 1 :** Étant donné que le visiteur vient de créer un compte par email,
    quand il est redirigé vers le tableau de bord,
    alors un profil vide lui est attribué et il peut les actualiser depuis "Mon profil".

    - **C.A 2 :** Étant donné que l'utilisateur est connecté,
    quand il accède à la page "Mon profil",
    alors il voit ses informations actuelles : nom, âge, photo ou avatar par défaut.


    - **C.A 3:** Étant donné que le visiteur se connecte via Google pour la première fois,
    quand il accepte les autorisations,
    alors son profil est pré-rempli avec les donnes récupérés depuis son compte Google.

    - **C.A 4:** Étant donné que l'utilisateur est sur "Mon profil",
    quand il modifie son nom et/ou son âge et valide,
    alors les nouvelles informations sont enregistrées et mises à jour dans la base de données.

    - **C.A 5:** Étant donné que l'utilisateur souhaite ajouter ou changer sa photo,
    quand il sélectionne un fichier image valide (JPG, PNG) et valide,
    alors la photo est sauvegardée sur le serveur et associée à son profil, remplaçant l'ancienne.

    - **C.A 6:** Étant donné que l'utilisateur modifie son profil,
    quand il soumet le formulaire,
    alors toutes les données sont échappées, le fichier image est vérifié côté serveur pour empêcher tout code malveillant, et les champs vides restent acceptables.


## EPIC 4 – Administration

- **User Story 11 :** En tant qu’administrateur connecté, je veux pouvoir consulter la liste de tous les commentaires publiés et supprimer ceux qui sont inappropriés, afin de garantir la qualité et la sécurité des échanges sur l’application.

    - **C.A 1 :**Étant donné qu’un utilisateur connecté n’a pas le rôle admin,
    quand il tente d’accéder à la page de modération,   
    alors le système le déconnecte automatiquement, affiche le message "Accès non autorisé" et le redirige vers le formulaire de connexion.

    - **C.A 2 :** Étant donné que l’administrateur est connecté et accède à la section "Modération",
    quand la page se charge,
    alors il voit la liste de tous les commentaires, classés par date, avec : le texte, le nom du supplément concerné, l’auteur, et la date de publication.

    - **C.A 3 :** Étant donné que l’administrateur consulte la liste des commentaires,
    quand il clique sur "Supprimer" à côté d’un commentaire et confirme l’action,
    alors le commentaire est définitivement retiré de la base de données et disparaît de la fiche supplément correspondante.

    - **C.A 4 :** Étant donné que l’administrateur effectue une action de modération,
    quand la requête est envoyée,
    alors le système vérifie un jeton CSRF pour éviter les attaques, et tous les commentaires affichés sont échappés pour prévenir toute injection XSS.

- **User Story 12 :** En tant qu’administrateur connecté, je veux pouvoir ajouter un nouveau supplément au catalogue ou retirer un supplément existant, afin de maintenir à jour les informations proposées aux utilisateurs.

    - **C.A 1 :** Étant donné que l’administrateur est connecté et accède à la section "Gestion des suppléments",
    quand la page se charge,
    alors il voit la liste de tous les suppléments existants, avec leur nom et un bouton <button>Supprimer</button> pour chacun.

    - **C.A 2 :** Étant donné que l’administrateur souhaite ajouter un nouveau supplément,
    quand il remplit le formulaire: nom, description, bienfaits, posologie recommandée, durée recommandée, moment de prise, précautions et valide,
    alors le supplément est créé dans la base de données et apparaît immédiatement dans le catalogue public.

    - **C.A 3 :** Étant donné que l’administrateur souhaite supprimer un supplément,
    quand il clique sur « Supprimer » et confirme l’action,
    alors le supplément est retiré de la base de données, ainsi que tous les commentaires et suivis associés, et il n’est plus visible dans le catalogue.

    - **C.A 4 :** Étant donné que le formulaire d’ajout est soumis avec des champs obligatoires vides,
    quand l’administrateur valide,
    alors un message d’erreur explicite lui demande de remplir les champs requis.

    - **C.A 5 :** Étant donné que les données saisies sont enregistrées,
    quand elles contiennent des caractères spéciaux ou du code malveillant,
    alors le système échappe les caractères et empêche toute exécution de code.

    - **C.A 6 :** Étant donné qu’un utilisateur connecté n’a pas le rôle admin,
    quand il tente d’accéder à la section "Gestion des suppléments",
    alors le système le déconnecte automatiquement, affiche le message "Accès non autorisé" et le redirige vers le formulaire de connexion.
