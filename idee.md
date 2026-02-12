Parfait 👍 je comprends mieux ton besoin :  
👉 Tu veux **deux modèles distincts** : un pour **Coach** et un pour **Client**.  
- Le **Coach** doit **postuler** → sa candidature peut être acceptée ou refusée (donc il n’entre dans la table qu’après validation).  
- Le **Client** lui s’inscrit directement et peut se connecter.  

Je vais donc te lister uniquement les fonctions nécessaires pour chaque modèle et leurs contrôleurs.

---

# 📂 Fonctions nécessaires

## 1. **Client**
- **Model**
  - `createClient()` → inscription d’un client  
  - `getClientById($id)` → récupérer un client  
  - `getClientByEmail($email)` → chercher par email (utile pour login)  
  - `updateClient($id, $data)` → modifier profil  
  - `deleteClient($id)` → supprimer compte   
  - `authenticateClient($email, $password)` → connexion  

- **Controller**
  - `registerClient()`  
  - `loginClient()`  
  - `logoutClient()`  
  - `updateClientProfile()`  
  - `deleteClientAccount()`  
  - `listClients()`  

---

## 2. **Coach**
- **Model**
  - `createCoachApplication()` → soumettre une candidature  
  - `getCoachApplicationById($id)` → récupérer une candidature  
  - `getAllCoachApplications()` → liste des candidatures  
  - `updateCoachApplication($id, $data)` → modifier candidature  
  - `deleteCoachApplication($id)` → supprimer candidature  
  - `approveCoachApplication($id)` → valider candidature (ajout dans table Coach)  
  - `rejectCoachApplication($id)` → refuser candidature  
  - `getCoachById($id)` → récupérer un coach validé  
  - `getAllCoaches()` → liste des coachs validés  
  - `authenticateCoach($email, $password)` → connexion coach validé  

- **Controller**
  - `applyCoach()` → soumettre candidature  
  - `listCoachApplications()` → voir toutes les candidatures  
  - `approveCoach()` → valider candidature  
  - `rejectCoach()` → refuser candidature  
  - `loginCoach()`  
  - `logoutCoach()`  
  - `updateCoachProfile()`  
  - `deleteCoachAccount()`  
  - `listCoaches()`  

---

# 👨‍💼 Fonctions Admin (Java)

L’admin gère la validation des coachs et la supervision des clients :

- **Gestion Coachs**
  - `viewAllCoachApplications()`  
  - `approveCoachApplication($id)`  
  - `rejectCoachApplication($id)`  
  - `banCoach($id)`  
  - `activateCoach($id)`  

- **Gestion Clients**
  - `viewAllClients()`  
  - `banClient($id)`  
  - `activateClient($id)`  
  - `resetClientPassword($id)`  

- **Statistiques**
  - `getClientStatistics()`  
  - `getCoachStatistics()`  
  - `getProgrammeStatistics()`  
  - `getGlobalProgressionStats()`  

---

👉 Résumé :  
- **Deux modèles séparés** : `Client` et `Coach`.  
- Le **Coach** passe par une étape de **candidature** avant d’être validé.  
- Le **Client** s’inscrit directement.  
- L’**Admin** gère la validation des coachs et la supervision des clients.  






Parfait 👌 je vais te donner la **structure SQL des tables** pour ton projet, avec deux modèles séparés : **Client** et **Coach** (et une table pour gérer les candidatures des coachs).  

---

# 📂 Structure SQL

## 1. **Table Client**
```sql
CREATE TABLE Client (
    id_client INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    date_naissance DATE,
    sexe ENUM('H', 'F', 'Autre'),
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## 2. **Table CoachApplication** (candidature des coachs)
```sql
CREATE TABLE CoachApplication (
    id_application INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    experience TEXT, -- description de l’expérience sportive/professionnelle
    diplome VARCHAR(255), -- diplômes ou certifications
    statut ENUM('En attente', 'Approuvé', 'Refusé') DEFAULT 'En attente',
    date_candidature TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## 3. **Table Coach** (uniquement si candidature validée)
```sql
CREATE TABLE Coach (
    id_coach INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    experience TEXT,
    diplome VARCHAR(255),
    date_validation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## 4. **Table Programme**
```sql
CREATE TABLE Programme (
    id_programme INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(150) NOT NULL,
    description TEXT,
    objectif ENUM('Perte de poids', 'Prise de masse', 'Remise en forme', 'Maintien'),
    duree INT, -- en semaines
    id_coach INT,
    FOREIGN KEY (id_coach) REFERENCES Coach(id_coach) ON DELETE SET NULL
);
```

---

## 5. **Table Objectif**
```sql
CREATE TABLE Objectif (
    id_objectif INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT,
    type ENUM('Perte de poids', 'Prise de masse', 'Remise en forme', 'Maintien'),
    description TEXT,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_client) REFERENCES Client(id_client) ON DELETE CASCADE
);
```

---

## 6. **Table Progression**
```sql
CREATE TABLE Progression (
    id_progression INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT,
    id_programme INT,
    semaine INT,
    resultat TEXT, -- notes ou mesures (poids, performances…)
    date_suivi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_client) REFERENCES Client(id_client) ON DELETE CASCADE,
    FOREIGN KEY (id_programme) REFERENCES Programme(id_programme) ON DELETE CASCADE
);
```

---

# ✅ Résumé
- **Client** : inscription directe.  
- **CoachApplication** : candidature en attente/validée/refusée.  
- **Coach** : uniquement si candidature validée.  
- **Programme** : créé par un coach validé.  
- **Objectif** : fixé par le client.  
- **Progression** : suivi des résultats du client sur un programme.  

---


Parfait ✅ merci pour la précision.  
Donc on garde uniquement **4 tables** : **Client**, **CoachApplication**, **Coach**, **Programme**, et **Progression**. La table **Objectif** est inutile car les objectifs sont déjà intégrés dans les programmes.

---

# 📂 Relations entre les tables (MCD simplifié)

### 1. **Client**
- Un **Client** peut s’inscrire directement.  
- Un **Client** peut suivre **plusieurs Programmes**.  
- Un **Client** a une **Progression** liée à chaque Programme suivi.  

**Relations :**
- `Client (1) —— (N) Progression`  
- `Client (N) —— (N) Programme` (via Progression ou une table d’association si besoin)

---

### 2. **CoachApplication**
- Un **Coach** doit d’abord passer par une **CoachApplication**.  
- Une candidature peut être **approuvée** ou **refusée**.  
- Si elle est approuvée → insertion dans la table **Coach**.  

**Relations :**
- `CoachApplication (1) —— (0..1) Coach` (seulement si validé)

---

### 3. **Coach**
- Un **Coach** validé peut créer **plusieurs Programmes**.  
- Un **Coach** est lié à ses Programmes.  

**Relations :**
- `Coach (1) —— (N) Programme`

---

### 4. **Programme**
- Un **Programme** est créé par un **Coach**.  
- Un **Programme** peut être suivi par **plusieurs Clients**.  
- La progression des Clients est enregistrée dans **Progression**.  

**Relations :**
- `Programme (1) —— (N) Progression`  
- `Programme (N) —— (N) Client` (via Progression)

---

### 5. **Progression**
- Sert de **table d’association** entre **Client** et **Programme**.  
- Stocke les résultats/semaine du Client sur un Programme.  

**Relations :**
- `Progression (N) —— (1) Client`  
- `Progression (N) —— (1) Programme`

---

# ✅ Résumé visuel (MCD simplifié)

- **Client** ↔ **Programme** (relation N-N via **Progression**)  
- **CoachApplication** → **Coach** (si validé)  
- **Coach** ↔ **Programme** (relation 1-N)  
- **Programme** ↔ **Progression** ↔ **Client**

---

👉 Ça te donne un schéma clair :  
- Les **Clients** s’inscrivent et suivent des Programmes.  
- Les **Coach** doivent postuler, et s’ils sont validés, ils créent des Programmes.  
- La **Progression** fait le lien entre Client et Programme.  




Soumission candidature → insertion dans candidat avec statut = en_attente.

Validation admin (via app Java) → transfert des données vers coach, mise à jour du statut = valide.

Refus admin → statut = refuse.

Nettoyage automatique (via ta méthode supprimerCandidatsExpirés) :

Suppression des candidats refusés après 15 jours.

Suppression des candidats validés après 15 jours (car déjà transférés dans coach).