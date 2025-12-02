
# BasicFit – Projet CFA INSTA – Client Léger  
## Plateforme de Formation et de Coaching Sportif

### Contexte du projet
Le projet **Basic-Fit Training** est une plateforme web développée dans le cadre d’un projet étudiant du CFA INSTA.  
Son objectif est de mettre en relation les adhérents Basic-Fit et les coachs sportifs, selon leurs objectifs personnels, tout en proposant une expérience interactive et motivante.  

La plateforme permet aux utilisateurs de suivre des programmes d’entraînement en ligne, adaptés à leurs besoins :  
- Perte de poids  
- Prise de masse  
- Remise en forme  
- Maintien d’une activité physique régulière  

L’accent est mis sur la simplicité d’utilisation, la personnalisation du suivi et une navigation claire entre les trois rôles principaux : **client, coach et administrateur**.  
Le site est pensé pour être intuitif, fluide et responsive, utilisable aussi bien sur ordinateur que sur mobile.

---

### Fonctionnement général
Lorsqu’un visiteur arrive sur le site, il découvre la présentation du concept Basic-Fit Training et les différents types de coaching proposés.  
Pour accéder au service, il doit créer un compte utilisateur via un formulaire d’inscription comprenant :  
- Nom, prénom, adresse e-mail, mot de passe  
- Poids, taille, objectif sportif  
- Jours de disponibilité (minimum 3, maximum 5 par semaine)  
- Créneaux horaires disponibles (matin, midi, soir)  
- Une courte description personnelle (motivation, attentes, etc.)  

Une fois validée, la demande est automatiquement envoyée aux coachs correspondant à la spécialité choisie.  

---

### Côté coach
Les coachs peuvent postuler directement via la rubrique **“Postuler comme coach”**.  
Ils renseignent leurs informations personnelles :  
- Nom, prénom, adresse e-mail, adresse postale  
- Spécialité sportive (prise de masse, sèche, remise en forme)  
- Dépôt de leur CV  

Toutes les candidatures sont vérifiées par l’administrateur.  
Lorsqu’un coach est accepté, il reçoit un mail de confirmation avec ses identifiants et un lien vers l’Espace Coach.  

Dans cet espace, le coach peut :  
- Consulter les demandes en attente correspondant à sa spécialité  
- Accepter ou refuser une demande  
- Gérer la liste de ses clients attribués  
- Voir les informations complètes de chaque client (objectif, jours, créneaux, motivation)  

Lorsqu’un coach accepte une demande :  
- Elle disparaît automatiquement des autres coachs de la même spécialité  
- Le client devient officiellement rattaché à ce coach  
- Il apparaît dans la section **“Mes clients”** du coach  

---

### Espace client
Une fois sa demande acceptée, le client accède à son tableau de bord personnel, où il peut voir :  
- Les informations de son coach (nom, e-mail, téléphone)  
- Les jours et horaires d’entraînement choisis lors de l’inscription  
- Le statut de sa demande (“Acceptée”)  

Cette interface simple et claire permet au client de suivre son emploi du temps et de contacter son coach en cas de besoin.  

---

### Espace administrateur
L’administrateur dispose d’un espace de gestion complet. Il peut :  
- Gérer les candidatures des coachs  
- Accepter ou refuser les coachs  
- Créer les comptes et envoyer les mails d’accès  
- Consulter, modifier ou supprimer les comptes clients et coachs  
- Superviser toutes les demandes en cours et les attributions coach–client  

Cet espace garantit une organisation claire et un contrôle total du fonctionnement de la plateforme.  

---

### Design et ergonomie
Le design du site repose sur le framework **Bootstrap**, afin d’assurer :  
- Une interface moderne et responsive  
- Une cohérence visuelle sur tous les supports (ordinateur, tablette, mobile)  
- Un développement rapide et structuré des composants graphiques  

L’utilisation de Bootstrap permet de garantir une expérience utilisateur fluide et conforme aux standards du web actuel.  

---

### Objectif pédagogique
Ce projet s’inscrit dans le cadre d’un projet étudiant du CFA INSTA, visant à mettre en pratique les compétences en :  
- Développement web  
- Conception et modélisation de base de données  
- Architecture MVC  
- UX/UI design  
- Gestion de projet numérique  

Il illustre la conception d’une plateforme complète alliant sport, technologie et expérience utilisateur.  

---

### Structure du projet
Le projet est organisé selon une architecture **MVC (Modèle – Vue – Contrôleur)**, qui permet une meilleure séparation du code et une maintenance facilitée.  

- `/bdd/` → fichiers liés à la base de données (scripts SQL, connexion, etc.)  
- `/controller/` → logique entre modèle et vue  
- `/model/` → gestion des données et requêtes SQL  
- `/view/` → pages visibles par l’utilisateur (HTML, CSS, JS)  
- `/docs/` → documentation du projet (MCD, schéma de base, notes techniques)  

#### À propos du MCD
Le **Modèle Conceptuel de Données (MCD)** définit :  
- Les entités (Utilisateur, Programme, Exercice, Objectif…)  
- Leurs attributs (nom, âge, email…)  
- Les relations entre elles (ex. : un utilisateur peut suivre plusieurs programmes)  

Le MCD est une étape essentielle pour structurer la base de données avant sa mise en œuvre technique.  

---

### Bonnes pratiques de collaboration
- Ne poussez jamais vos fichiers de configuration locale (base de données, chemins spécifiques…)  
- Commentez vos modifications locales  
- Stashez les fichiers sensibles avant de faire un commit  
- Respectez la structure MVC pour garder le projet clair et maintenable  

---

### Objectif et valeur ajoutée
Le projet Basic-Fit Training modernise la relation entre coachs et adhérents Basic-Fit grâce à un système automatisé, fluide et efficace.  
Chaque utilisateur définit ses disponibilités dès l’inscription, ce qui rend la mise en relation rapide et pertinente.  
Les coachs disposent d’un espace clair pour gérer leurs clients, tandis que les administrateurs supervisent l’ensemble du site.  

Ce projet se distingue par :  
- Sa simplicité d’utilisation  
- Sa logique fonctionnelle bien pensée  
- Son potentiel d’évolution (ajout futur de messagerie, suivi d’abonnements, statistiques, etc.)  

**Basic-Fit Training relie efficacement clients, coachs et administrateurs autour d’un objectif commun : rendre l’entraînement plus accessible, encadré et motivant.**

---
