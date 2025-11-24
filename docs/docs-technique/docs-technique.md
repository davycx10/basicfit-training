DOCUMENTATION TECHNIQUE
Projet : Basic-Fit Training
Client : Basic-Fit
 Prestataire : FitConnect
 Date : Novembre 2025

SOMMAIRE
Introduction


Technologies utilisées


Architecture du projet 


Structure des dossiers


Fonctionnement du code principal


Connexion à la base de données


Base de données (MCD et tables principales)


Sécurité et bonnes pratiques


Maintenance et évolutivité (optionnel)



1. Introduction
Le projet Basic-Fit Training est une plateforme web permettant de mettre en relation les adhérents Basic-Fit et des coachs sportifs selon leurs objectifs (prise de masse, sèche, remise en forme).
Ce document présente les aspects techniques du développement, les choix d’architecture, la structure du code, et le fonctionnement général du site.
 L’objectif est de fournir un guide clair et structuré pour tout développeur souhaitant comprendre, maintenir ou faire évoluer le projet.

2. Technologies utilisées
Catégorie
Technologie / Outil
Rôle
Langage serveur
PHP 8.
Back-end, routage, gestion des données
Langages front-end
HTML5 / CSS3 / JavaScript
Structure, mise en page, interactions
Framework CSS
Bootstrap 5 + Webfleb
Design responsive et composants visuels
Base de données
MySQL
Gestion des utilisateurs, coachs et disponibilités
Serveur local
XAMPP / WAMP/LAMP
Environnement de développement
Serveur web
Apache
Exécution du code PHP
Versioning
GitHub
Suivi des versions et collaboration
Outils annexes
phpMyAdmin / Figma / Trello
Gestion BDD, design et organisation

Ces choix technologiques garantissent :
un développement rapide,


un design responsive,


une compatibilité multiplateforme (ordinateur, smartphone).



3. Architecture du projet
Le site repose sur une architecture MVC simplifiée (Modèle – Vue – Contrôleur).
 Cette organisation permet de séparer les responsabilités tout en conservant un routage simple dans index.php.
Schéma général :
Utilisateur → index.php → View → Controller → Model → Base de données


Description des rôles :
Model (Modèle) : contient les requêtes SQL et la gestion des données.


View (Vue) : regroupe les pages HTML/PHP affichées à l’utilisateur.


Controller (Contrôleur) : gère les interactions complexes (ajout, suppression, connexion, etc.).


L’architecture semi-MVC choisie permet :
une navigation rapide via un switch dans index.php,


une intégration fluide des fichiers PHP,


une maintenance plus simple pour un projet de taille moyenne.



4. Structure des dossiers
Voici l’organisation du projet :
/bdd/                → fichiers de connexion et scripts SQL
/controller/         → contrôleurs (logique entre modèle et vue)
   /coach/           → fonctionnalités liées aux coachs
   /client/          → fonctionnalités liées aux adhérents
/model/              → modèles contenant les requêtes SQL
   /coach/           → modèles coach
   /client/          → modèles client
/view/               → pages visibles (HTML, PHP)
   /commun/          → header.php, footer.php
   /client/         → pages des client …
   /coach/         → pages coach …
/docs/               → documentation, schémas, MCD
/style/              → CSS personnalisée ou issue de Webflow
index.php            → point d’entrée principal du site


Logique de fonctionnement :
Le header et le footer sont inclus dynamiquement sur toutes les pages.


Les pages internes sont chargées selon la valeur du paramètre $_GET['page'].


Les controllers sont appelés pour des actions spécifiques (CRUD, connexion…).



5. Fonctionnement du code principal
Fichier index.php
C’est le cœur du routage. Il inclut les fichiers communs (header/footer) et affiche la page correspondant à la requête.





    
default:
        include ('view/accueil.php');
        break;
}

// Inclusion du pied de page commun
include ('view/commun/footer.php');
?>

Explication :
include() permet de charger les fichiers réutilisables (header/footer).


Le switch gère les différentes pages du site à partir du paramètre $_GET['page'].


Si la page n’existe pas, l’utilisateur est redirigé vers la page d’accueil.


Cette méthode offre un routage clair et maintenable.



6. Connexion à la base de données
Le fichier /bdd/connexion.php établit une connexion à la base MySQL via PDO.
 Il est inclus dans les modèles qui ont besoin d’accéder aux données.
exemple de code : 
Code :
<?php
try {
    $users = "";
    $pass = "";
    $bdd = new PDO('mysql:host=localhost;dbname=DBNAME', $users, $pass);
} catch (PDOException $e) {
    print "Erreur ! : " . $e->getMessage() . "<br/>";
    die();
}
?>


Explications :
PDO permet une connexion sécurisée et portable.


Le bloc try/catch gère les erreurs et empêche les crashs en cas d’échec de connexion.


Dans la version finale, la base portera le nom basicfit_training.


Les identifiants seront déplacés dans un fichier config séparé pour plus de sécurité.



7. Base de données (MCD et tables principales)
La base MySQL contient les informations relatives aux utilisateurs, coachs et disponibilités.
MCD simplifié :
[Utilisateur] 1—N [Disponibilite]
      |
      ├──> type (client / coach / admin)
      ├──> objectif
      └──> description

[Message] lie les utilisateurs (client ↔ coach)

Tables principales :
Table utilisateur
Champ
Type
Description
id
INT (PK)
Identifiant unique
nom
VARCHAR(50)
Nom
prenom
VARCHAR(50)
Prénom
email
VARCHAR(100)
Adresse e-mail
mot_de_passe
VARCHAR(255)
Mot de passe (hashé)
type
ENUM('client','coach','admin')
Rôle de l’utilisateur
poids
FLOAT
Poids (optionnel)
taille
FLOAT
Taille (optionnel)
objectif
VARCHAR(50)
Objectif sportif
description
TEXT
Description personnelle

Table disponibilite
Champ
Type
Description
id
INT (PK)
Identifiant
id_utilisateur
INT (FK)
Lien vers utilisateur
jour
VARCHAR(20)
Jour de disponibilité
creneau
ENUM('matin','midi','soir')
Créneau horaire

Table message
Champ
Type
Description
id
INT (PK)
Identifiant du message
expediteur_id
INT (FK)
ID expéditeur
destinataire_id
INT (FK)
ID destinataire
contenu
TEXT
Contenu du message
date_envoi
DATETIME
Date et heure d’envoi


8. Sécurité et bonnes pratiques
Pour garantir la fiabilité du site, plusieurs règles de sécurité sont appliquées :
Aspect
Mesure appliquée
Mot de passe
Hashage avec password_hash() et vérification via password_verify()
Requêtes SQL
Utilisation de requêtes préparées PDO
Entrées utilisateur
Filtrage avec htmlspecialchars() et filter_input()
Sessions
Utilisation de session_start() et gestion par rôle
Erreurs PDO
Désactivation en production
Fichiers sensibles
Configurations déplacées hors du dossier public

Ces bonnes pratiques assurent une protection contre les injections SQL et XSS, tout en maintenant un code stable et lisible.

9. Maintenance et évolutivité
Le projet a été conçu pour être modulaire et extensible :
Possibilité d’ajouter facilement de nouvelles sections dans /view/, /controller/ et /model/.


Adaptable à d’autres types d’utilisateurs ou fonctionnalités (paiement, statistiques…).


Documentation technique intégrée dans /docs/ pour faciliter la reprise.


Code commenté et versionné sur GitHub.


Tâches de maintenance prévues :
Sauvegardes régulières de la base MySQL.


Vérification des dépendances Bootstrap.


Nettoyage du code et des includes inutilisés.


Tests fonctionnels après chaque mise à jour.




Conclusion
Le site Basic-Fit Training repose sur une architecture PHP claire et efficace, basée sur un MVC semi-classique et une connexion PDO sécurisée.
 Son design responsive, son code modulaire et sa base de données structurée garantissent un outil performant et évolutif.
Cette documentation technique sert de référence pour la compréhension, la maintenance et l’amélioration du projet à long terme.

