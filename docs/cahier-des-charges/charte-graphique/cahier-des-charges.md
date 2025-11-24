# CAHIER DES CHARGES – Basic-Fit Training

**Projet :** Basic-Fit Training  
**Client :** Basic-Fit  
**Prestataire :** FitConnect  
**Date :** Novembre 2025

---

## 1. Introduction

### 1.1 Contexte

Basic-Fit souhaite développer une plateforme web permettant de mettre en relation les adhérents avec des coachs sportifs spécialisés selon les objectifs personnels de chacun. Le site doit être simple, rapide et accessible, sans nécessiter d'application mobile complexe.

### 1.2 Objectifs du projet

- Permettre aux adhérents de créer un compte et définir leur profil sportif
- Faciliter la sélection et le suivi personnalisé par un coach
- Proposer un site intuitif, fluide et accessible sur ordinateur et smartphone
- Optimiser la communication entre client, coach et administrateur

---

## 2. Périmètre du projet

### 2.1 Inclus

- Gestion des comptes utilisateurs (adhérents et coachs)
- Gestion des objectifs sportifs et des disponibilités
- Gestion des créneaux horaires et plannings
- Interface administrateur pour supervision
- Design responsive avec Bootstrap et Webflow
- Développement PHP/MySQL avec architecture MVC

### 2.2 Exclus

- Développement d'une application mobile native
- Gestion des paiements en ligne
- Connexion à d'autres plateformes externes (hors besoins futurs)

---

## 3. Fonctionnalités détaillées

### 3.1 Fonctionnalités utilisateurs

#### Adhérents

- Création et gestion de compte : nom, prénom, email, mot de passe
- Saisie de profil : poids, taille, objectif sportif, motivation
- Choix des jours et créneaux de disponibilité (3 à 5 jours, matin/midi/soir)
- Consultation de l'historique des séances et suivi du coach
- Messagerie ou notifications pour échanges avec le coach

#### Coachs

- Consultation des demandes des adhérents selon leur spécialité
- Validation et suivi des plannings et séances
- Gestion de son profil professionnel

#### Administrateur

- Supervision des utilisateurs (adhérents et coachs)
- Gestion des objectifs sportifs et des plannings
- Consultation des statistiques d'utilisation du site

### 3.2 Fonctionnalités techniques

Développement PHP/MySQL avec architecture MVC :

- `/controller/` : logique de l'application
- `/model/` : gestion des données et requêtes SQL
- `/view/` : affichage HTML/CSS/JS avec Bootstrap/Webflow
- Page d'entrée : `index.php`, routeur centralisé pour charger les pages
- Connexion sécurisée à la base de données
- Mise en place d'un dossier `/style/` pour le CSS et `/js/` pour le code JS
- Gestion des sous-dossiers par fonctionnalités (ex : `/coach/`) pour modularité

---

## 4. Architecture technique

### 4.1 Organisation du projet

```
/bdd/              → Base de données
/controller/       → Contrôleurs
/model/            → Modèles
/view/             → Vues
    /commun/       → Header, footer, éléments réutilisables
    /coach/        → Pages spécifiques
/docs/             → Documentation
/style/            → CSS
/js/               → Scripts JS
index.php          → Page d'accueil et routeur
```

### 4.2 Technologies utilisées

- **Back-end :** PHP 8.x
- **Base de données :** MySQL
- **Front-end :** HTML5, CSS3, Bootstrap, Webflow
- **Scripts côté client :** JavaScript (optionnel)
- **Versioning :** Git

---

## 5. Contraintes

- **Accessibilité :** site responsive et rapide
- **Sécurité :** protection des données utilisateurs (mot de passe hashé, RGPD)
- **Compatibilité :** navigateurs modernes (Chrome, Firefox, Edge, Safari)
- **Maintenance :** code organisé pour faciliter évolutions futures

---

## 6. Livrables

- Site web complet fonctionnel sur serveur de test
- Code source organisé (MVC)
- Documentation technique et utilisateur :
  - Diagramme de la base de données (MCD)
  - Architecture MVC
  - Instructions d'installation et de déploiement
  - Documentation juridique et financière (déjà réalisées)

---

## 7. Planning prévisionnel

| Phase | Durée | Tâches principales |
|-------|-------|-------------------|
| Analyse & conception | 1 semaine | Étude besoins, architecture, MCD |
| Développement back-end | 3 semaines | Modèles, contrôleurs, base de données |
| Développement front-end | 3 semaines | Vues, design responsive, intégration Bootstrap/Webflow |
| Tests & validation | 1-2 semaines | Vérification fonctionnalités, corrections |
| Livraison finale | 1 semaine | Déploiement, documentation |

---

## 8. Budget estimatif

Voir documentation financière : **~5 500 €** couvrant développement, design, tests et hébergement.

---

## 9. Critères de réussite

- Plateforme fonctionnelle avec connexion et gestion des profils
- Possibilité pour chaque adhérent de trouver un coach adapté
- Respect des délais et du budget prévisionnel
- Site ergonomique, responsive et sécurisé
- Documentation complète et livrable pour le client

---

## 10. Annexes

- Schéma de base de données (MCD)
- Maquettes des pages principales (wireframes)
- Planning détaillé avec jalons
- Exemples de formulaires et interfaces utilisateurs