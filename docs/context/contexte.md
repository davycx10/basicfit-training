# Basic-Fit Training

## Presentation générale

**Basic-Fit Training** est une plateforme web conçue pour faciliter la mise en relation entre les adhérents Basic-Fit et les coachs sportifs selon leurs objectifs personnels. 

L'objectif est de proposer un site simple et fonctionnel permettant à chaque utilisateur de :
- S'inscrire
- Choisir son objectif sportif
- Préciser ses disponibilités
- Être pris en charge par un coach spécialisé

Le but du projet est de permettre aux adhérents de bénéficier d'un accompagnement adapté sans passer par une application mobile complexe. Le site doit être **intuitif**, **rapide à comprendre** et **accessible** sur ordinateur ou smartphone, en mettant l'accent sur :
- La simplicité d'utilisation
- La personnalisation du suivi
- La fluidité des échanges entre client, coach et administrateur

---

## Fonctionnement général

### Inscription et sélection de l'objectif sportif

Lorsqu'un visiteur arrive sur le site, il découvre :
- La présentation du concept Basic-Fit Training
- Les différents types de programmes proposés (prise de masse, sèche, remise en forme)
- Les avantages du suivi personnalisé

Pour accéder au service, l'utilisateur doit créer un compte en remplissant un formulaire d'inscription complet contenant les champs suivants :

| Champs | Description |
|--------|-------------|
| **Nom** | Nom de l'utilisateur |
| **Prénom** | Prénom de l'utilisateur |
| **Adresse e-mail** | Adresse e-mail unique |
| **Mot de passe** | Mot de passe sécurisé |
| **Poids** | Poids actuel en kg |
| **Taille** | Taille en cm |
| **Objectif sportif** | Prise de masse, sèche ou remise en forme |
| **Jours de disponibilité** | Entre 3 et 5 jours par semaine |
| **Créneaux horaires** | Trois créneaux possibles par jour (matin, midi, soir) |
| **Description personnelle** | Motivation, attentes, etc. |

Dès son inscription, le client **définit son emploi du temps d'entraînement et son objectif**. Une fois le formulaire validé, sa demande est automatiquement envoyée à **tous les coachs spécialisés** dans l'objectif choisi.

**Exemple :** Si l'utilisateur sélectionne "prise de masse", tous les coachs de cette spécialité recevront la demande.

---

## Côté coach

Les coachs peuvent postuler directement depuis la page principale du site via la rubrique **"Postuler comme coach"**.

### Processus d'inscription

Lors de l'inscription, ils indiquent :
- Nom
- Prénom
- Adresse e-mail
- Adresse postale
- Spécialité (prise de masse, sèche ou remise en forme)
- CV

Chaque demande est transmise à **l'administrateur** qui l'examine. Si la candidature est acceptée, le coach reçoit un e-mail de confirmation contenant :
- Son identifiant
- Son mot de passe
- Un lien vers l'**Espace Coach** (accessible depuis la page d'accueil)

### Espace Coach

Dans cet espace, le coach peut :
- Voir la liste des demandes en attente correspondant à sa spécialité
- Accepter ou refuser chaque demande
- Gérer sa liste de clients (rubrique "Mes clients")
- Supprimer un client si la collaboration prend fin

**Fonctionnement automatique :** Lorsqu'un coach accepte une demande, celle-ci :
- Disparaît automatiquement des tableaux des autres coachs de la même spécialité
- Le client devient officiellement rattaché à ce coach
- Le client apparaît dans la rubrique "Mes clients" avec toutes ses informations :
  - Nom, prénom
  - Objectif
  - Jours et créneaux choisis
  - Message de motivation

---

## Espace client

Du côté de l'utilisateur, dès qu'un coach **accepte sa demande**, son tableau de bord client se met automatiquement à jour. Il peut alors voir :

- **Informations du coach attribué** : nom, prénom, e-mail, téléphone
- **Jours et horaires d'entraînement** : ceux choisis lors de l'inscription
- **Statut de la demande** : passé de "en attente" à "acceptée"

Cette interface permet au client de :
- Garder une vue claire sur son emploi du temps
- Contacter son coach facilement

Le système reste **volontairement simple** pour offrir une expérience **fluide, rapide et motivante**.

---

## Espace administrateur

L'administrateur gère l'ensemble du site depuis son interface d'administration. Il peut :

- Recevoir les demandes de candidature des coachs
- Accepter ou refuser les candidatures
- Créer les comptes des coachs et générer leurs identifiants
- Envoyer automatiquement des e-mails de confirmation
- Consulter la liste complète des coachs et des clients
- Modifier ou supprimer un compte
- Superviser les demandes de clients et les attributions coach-client
- Assurer le bon fonctionnement global du site

---

## Objectif et valeur ajoutée du projet

**Basic-Fit Training** vise à moderniser la relation entre les coachs et les adhérents en créant une **plateforme claire et automatisée**.

### Avantages pour chaque acteur

#### Pour les clients :
- Définir son rythme et ses disponibilités dès l'inscription
- Mise en relation instantanée et pertinente avec un coach spécialisé
- Vue claire et simple de son emploi du temps d'entraînement

#### Pour les coachs :
- Espace personnel pour gérer facilement leurs clients
- Accepter ou refuser des demandes en toute simplicité
- Gestion fluide de leur portefeuille clients

#### Pour l'administrateur :
- Contrôle complet du système
- Validation des coachs et gestion des comptes
- Supervision des interactions et attributions

### Valeur globale
Cette structure assure :
- Une organisation efficace
- Un gain de temps important
- Une expérience professionnelle pour tous les acteurs

**Basic-Fit Training** est une **solution web complète** permettant de relier facilement les coachs et les clients autour d'un objectif commun : **rendre l'entraînement plus accessible, encadré et motivant**.

---

## Fonctionnalités principales

- **Inscription simplifiée** : formulaire d'inscription pour les clients et les coachs
- **Recherche et correspondance automatique** : mise en relation automatique selon les objectifs sportifs
- **Gestion des plannings** : gestion des disponibilités et créneaux horaires
- **Tableau de bord** : espace client et coach pour la gestion des informations et plannings
- **Gestion administrative** : interface pour gérer les coachs, clients et l'ensemble du site