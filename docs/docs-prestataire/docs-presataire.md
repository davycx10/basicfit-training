DOCUMENTATION PRESTATAIRE
Projet : Basic-Fit Training
Prestataire : FitConnect
 Client : Basic-Fit
 Date : Novembre 2025

SOMMAIRE
Introduction du projet


Présentation du client et du besoin


Objectifs et périmètre du projet


Analyse fonctionnelle


Architecture du projet (MVC et structure des dossiers)


Cahier des charges technique


Description des fonctionnalités


Charte graphique et ergonomie


Organisation du travail et gestion de projet


Planning prévisionnel


Outils utilisés


Maintenance et évolutivité


Conclusion




1. Introduction du projet
Le projet Basic-Fit Training est une plateforme web visant à mettre en relation les adhérents Basic-Fit avec des coachs sportifs selon leurs objectifs personnels (prise de masse, sèche, remise en forme).
Notre rôle en tant que prestataire est de concevoir, développer et livrer une solution web ergonomique, personnalisée et simple d’utilisation.
Cette documentation présente la conception technique, l’architecture MVC, les technologies choisies, ainsi que l’organisation du développement de l’équipe prestataire.

2. Présentation du client et du besoin
Le client : Basic-Fit
Basic-Fit est une enseigne internationale de clubs de sport qui met l’accent sur la performance et l’accessibilité.
 Son objectif : proposer un service digital complémentaire aux adhérents, sans complexité technique.
Le besoin exprimé :
Simplifier la mise en relation entre coachs et adhérents via un site web.


Permettre l’inscription, le choix d’un objectif sportif et des créneaux d’entraînement.


Offrir un outil intuitif accessible sur PC et smartphone.


Respecter l’image et les codes graphiques de Basic-Fit.




3. Objectifs et périmètre du projet
Objectif principal
Mettre en place une plateforme web fonctionnelle et responsive pour gérer la mise en relation entre les adhérents et les coachs.
Objectifs secondaires
Gestion automatique des profils utilisateurs.


Espace dédié pour chaque type d’utilisateur (adhérent, coach, administrateur).


Interface simple et ergonomique.


Base de données relationnelle pour gérer comptes, coachs et disponibilités.


Hors périmètre
Pas d’application mobile native.


Pas de système de paiement en ligne pour cette version.



4. Analyse fonctionnelle
Profils utilisateurs
Adhérent : crée un compte, définit ses objectifs, consulte les coachs disponibles.


Coach : reçoit les demandes liées à sa spécialité, contacte les clients.


Administrateur : gère les utilisateurs, les coachs et supervise les échanges.(client lourd)



Fonctionnalités principales
Fonction
Description
Inscription
Création de compte avec les informations personnelles et sportives
Connexion
Accès sécurisé aux espaces personnels
Gestion du profil
Modification des données personnelles et sportives
Messagerie
Échanges entre coachs et adhérents
Espace administrateur
Supervision et gestion globale du site
Affichage des coachs
Filtrage automatique selon la spécialité choisie
Base de données
Centralisation des informations utilisateurs et objectifs


5. Architecture du projet (MVC et structure des dossiers)
Le projet Basic-Fit Training suit une architecture MVC (Modèle – Vue – Contrôleur) afin d’assurer une meilleure séparation des responsabilités et une maintenance facilitée.
Rôle des couches MVC :
Modèle (Model) : gère la logique métier, les données et les requêtes SQL.


Vue (View) : interface utilisateur (HTML, CSS, JS).


Contrôleur (Controller) : fait le lien entre la vue et le modèle, et contrôle les actions.


Structure du projet :
/bdd/                → fichiers SQL, scripts de création de la base
/controller/         → logique métier (liaison modèle/vue)
/model/              → classes et requêtes SQL (gestion BDD)
/view/               → pages HTML/PHP visibles par l’utilisateur
/docs/               → documentation, MCD, schémas techniques
/style/              → fichiers CSS (Bootstrap, Webflow, styles personnalisés)
/js/                 → scripts JavaScript si nécessaires
index.php            → page d’entrée du site (routeur principal)


Exemple d’organisation interne :
Si une nouvelle fonctionnalité concerne le coach, un sous-dossier coach/ sera créé dans chaque dossier principal :
/model/coach/  
/controller/coach/  
/view/coach/

Cette organisation garantit une meilleure modularité du code.

6. Cahier des charges technique
Élément
Choix technique
Langage principal
PHP
Front-end
HTML5, CSS3, Bootstrap, Webfleb
Base de données
MySQL
Serveur
Apache (en local via XAMPP / WAMP)
Architecture
MVC
Framework CSS
Bootstrap + Webfleb
Versioning
GitHub
Navigation
PHP router (via index.php)
Normes
RGPD, responsive design, accessibilité


Contraintes techniques :
Code clair et commenté.


Architecture modulaire.


Design responsive (mobile-first).


Sécurité renforcée (hashage des mots de passe).



7. Description des fonctionnalités
 Espace adhérent
Inscription et connexion.


Sélection de l’objectif sportif.


Gestion de son emploi du temps (jours et créneaux).


Messagerie avec le coach.


 Espace coach
Consultation des nouvelles demandes d’adhérents.


Communication via la messagerie interne.


Gestion de son profil et de ses spécialités.


 Espace administrateur (côté app lourd)
Gestion des utilisateurs et coachs.


Validation/suppression de comptes.


Statistiques globales. 




8. Charte graphique et ergonomie
Élément
Choix graphique
Couleur principale
Orange #FF6600
Couleur secondaire
Gris foncé / Blanc / Noir
Typographie
Roboto / Open Sans
Style visuel
Dynamique, clair, épuré
Composants UI
Bootstrap (cards, forms, navbars, modals)
Design général
Adapté mobile / desktop via Bootstrap Grid

Ergonomie
Navigation fluide : menu horizontal, liens visibles.


Pages allégées pour chargement rapide.


Interface accessible et compréhensible pour tout public.



9. Organisation du travail et gestion de projet
Méthodologie utilisée : Agile simplifiée
Le projet sera réalisé en plusieurs sprints avec des livrables intermédiaires.
Sprint
Durée
Objectif
1
1 semaine
Analyse du besoin, schéma BDD, architecture MVC
2
2 semaines
Développement du système d’inscription et de connexion
3
2 semaines
Mise en place de l’espace coach et adhérent
4
2 semaines
Espace administrateur et messagerie
5
1 semaine
Tests, corrections et livraison finale

Organisation de l’équipe :
Poste
Rôle
Chef de projet
Coordination et suivi global
Développeur back-end
PHP, MySQL, logique MVC
Développeur front-end
Intégration HTML/CSS/Bootstrap/Webflow
Designer UI/UX
Maquettes et cohérence visuelle
Testeur
Vérification, debug et validation finale


10. Planning prévisionnel
Phase
Durée estimée
Livrable attendu
Étude et conception
1 semaine
Cahier des charges, MCD
Développement
5 semaines
Site fonctionnel (v1)
Tests
2 semaines
Validation des fonctionnalités
Livraison
1 semaine
Déploiement final



11. Outils utilisés
Outil
Utilisation
VS Code (ou autre)
Éditeur principal
XAMPP / WAMP/Apache
Serveur local
phpMyAdmin
Gestion de la base MySQL
Bootstrap / Webflow
Framework CSS et design
GitHub
Suivi de version
Figma
Maquettes graphiques
Trello / Notion
Gestion du projet
Discord
Communication d’équipe


12. Maintenance et évolutivité
Une fois la version initiale livrée, plusieurs améliorations pourront être envisagées :
Système de paiement pour réserver un coach.


Application mobile connectée à la base web.


Statistiques personnalisées de progression pour les adhérents.


Chat en temps réel (WebSocket).


Maintenance prévue :
Sauvegardes automatiques de la base.


Vérification des formulaires et sécurité.


Mises à jour régulières des dépendances.




13. Conclusion
Le projet Basic-Fit Training repose sur une architecture MVC claire et modulaire, codée en PHP et stylisée avec Bootstrap et Webflow, garantissant performance et simplicité.
L’organisation du code, la séparation des rôles et la documentation intégrée permettront une maintenance aisée et des évolutions futures sans refonte complète.
Ce document sert de référence technique à l’équipe de développement et de base de suivi de production pour l’ensemble du projet.



