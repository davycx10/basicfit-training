<!-- // model/client/clientModel.php -->

<?php

/**
 * CLASSE CLIENT
 * =========================================
 * Gère toutes les opérations liées aux clients/adhérents:
 * - CRUD (Create, Read, Update, Delete)
 * - Authentification/Connexion
 * - Gestion du profil (poids, taille, objectif, etc.)
 * =========================================
 */
class Client {

    private $bdd;

    /**
     * CONSTRUCTEUR
     * =========================================
     * Initialise la connexion à la base de données
     * 
     * @param object $bdd - Connexion PDO à la base de données
     */
    function __construct($bdd){
        $this->bdd = $bdd;
    }

    /**
     * FONCTION: allClient()
     * =========================================
     * Récupère TOUS les clients de la base de données
     * 
     * Utilité: 
     * - Liste complète des clients (Admin)
     * - Affichage dans les sélecteurs
     * - Statistiques globales
     * - Export de données
     * 
     * @return array - Tableau de tous les clients avec leurs infos
     */
    public function allClient(){
        $req = $this->bdd->prepare("SELECT * FROM client");
        $req->execute();
        return $req->fetchAll();
    }

    /**
     * FONCTION: ajouterClient()
     * =========================================
     * Ajoute un NOUVEAU client dans la base de données
     * (Utilisé lors de l'inscription)
     * 
     * Utilité:
     * - Créer un compte client/adhérent
     * - Enregistrer le profil complet
     * - Stocker les données physiques (poids, taille)
     * - Enregistrer l'objectif de fitness
     * - Sauvegarder la motivation du client
     * 
     * Paramètres reçus:
     * - $nom: Nom du client (string)
     * - $prenom: Prénom du client (string)
     * - $mail: Email unique du client (string)
     * - $mdp: Mot de passe hashé du client (string)
     * - $poids: Poids actuel en kg (int/float)
     * - $taille: Taille en cm (int)
     * - $basic_fit: Salle Basic-Fit assignée (string/int)
     * - $objectif: Objectif fitness (prise_masse, seche, remise_forme)
     * - $description: Motivation/description du client (text)
     * 
     * Important:
     * - Le mot de passe doit être hashé AVANT l'appel à cette fonction
     * - La description est stockée dans la colonne 'motivation'
     * 
     * @return bool - true si l'insertion réussit, false sinon
     */
    public function ajouterClient($nom, $prenom, $mail, $mdp, $poids, $taille, $genre, $basic_fit, $objectif, $motivation){
        // Hashage du mot de passe AVANT insertion
        $hashedPassword = password_hash($mdp, PASSWORD_BCRYPT);

    $req = $this->bdd->prepare("
        INSERT INTO client 
        (nom, prenom, mail, mot_de_passe, poids, taille, genre, basic_fit, objectif, motivation)
        VALUES 
        (:nom, :prenom, :mail, :mot_de_passe, :poids, :taille, :genre, :basic_fit, :objectif, :motivation)
    ");

    $req->bindParam(':nom', $nom);
    $req->bindParam(':prenom', $prenom);
    $req->bindParam(':mail', $mail);
    $req->bindParam(':mot_de_passe', $hashedPassword);
    $req->bindParam(':poids', $poids);
    $req->bindParam(':taille', $taille);
    $req->bindParam(':genre', $genre);
    $req->bindParam(':basic_fit', $basic_fit);
    $req->bindParam(':objectif', $objectif);
    $req->bindParam(':motivation', $motivation); // <-- use the correct param name

        $success = $req->execute();
        if (!$success) {
            var_dump($req->errorInfo());
            exit;
}
return $success;
    }

    /**
     * FONCTION: modifierClient()
     * =========================================
     * Modifie les infos d'un client EXISTANT
     * (Édition du profil client)
     * 
     * Utilité:
     * - Permettre au client de modifier son profil
     * - Admin peut modifier les données
     * - Mise à jour du poids, taille, objectif, etc.
     * - Changement de la salle ou de l'objectif
     * 
     * Paramètres:
     * - $id_client: ID unique du client (int)
     * - $nom, $prenom, $mail, $mdp, $poids, $taille, $basic_fit, $objectif, $description: Nouvelles valeurs
     * 
     * Important:
     * - Le nouveau mot de passe doit être hashé AVANT l'appel
     * - Tous les champs sont mis à jour à la fois
     * 
     * @return bool - true si la mise à jour réussit, false sinon
     */
    public function modifierClient($id_client, $nom, $prenom, $mail, $mot_de_passe, $poids, $taille, $genre, $basic_fit, $objectif, $motivation){
        $hashedPassword = password_hash($mot_de_passe, PASSWORD_BCRYPT);

        $req = $this->bdd->prepare("
            UPDATE client
            SET nom = :nom, prenom = :prenom, mail = :mail, mot_de_passe = :mot_de_passe,
                poids = :poids, taille = :taille, genre = :genre, basic_fit = :basic_fit, 
                objectif = :objectif, motivation = :motivation
            WHERE id_client = :id_client
        ");

        $req->bindParam(':id_client', $id_client);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':mail', $mail);
        $req->bindParam(':mot_de_passe', $hashedPassword);
        $req->bindParam(':poids', $poids);
        $req->bindParam(':taille', $taille);
        $req->bindParam(':genre', $genre);
        $req->bindParam(':basic_fit', $basic_fit);
        $req->bindParam(':objectif', $objectif);
        $req->bindParam(':motivation', $motivation);

        return $req->execute();
    }


    /**
     * FONCTION: supprimerClient()
     * =========================================
     * SUPPRIME un client de la base de données
     * (Suppression complète du compte)
     * 
     * Utilité:
     * - Admin supprime un client
     * - Nettoyage des comptes inactifs
     * - Gestion administrative
     * 
     * Attention: 
     * - Cette action est IRRÉVERSIBLE
     * - À bien encadrer avec des confirmations
     * - Peut nécessiter de dissocier le client d'un coach d'abord
     * 
     * @param int $id_client - ID du client à supprimer
     * @return bool - true si la suppression réussit, false sinon
     */
    public function supprimerClient($id_client){
        $req = $this->bdd->prepare("DELETE FROM client WHERE id_client = :id_client");
        $req->bindParam(':id_client', $id_client);
        return $req->execute();
    }

    /**
     * FONCTION: selectById()
     * =========================================
     * Récupère les infos COMPLÈTES d'UN client par son ID
     * (Affichage du profil détaillé)
     * 
     * Utilité:
     * - Afficher le profil du client
     * - Charger les données pour modification
     * - Vérifier l'existence d'un client
     * - Récupérer les stats du client
     * 
     * @param int $id_client - ID du client recherché
     * @return object/array - Infos complètes du client (ou null si inexistant)
     */
    public function selectById($id_client){
        $req = $this->bdd->prepare("SELECT * FROM client WHERE id_client = :id_client");
        $req->bindParam(':id_client', $id_client);
        $req->execute();
        return $req->fetch();
    }

    /* =========================================
       FONCTION POUR L'AUTHENTIFICATION
       ========================================= */

    /**
     * FONCTION: getClientByEmail()
     * =========================================
     * Récupère les infos d'un client À PARTIR DE SON EMAIL
     * (Utilisé pour la CONNEXION/LOGIN)
     * 
     * Utilité:
     * - Vérifier si l'email existe dans la BDD
     * - Récupérer le mot de passe pour vérification
     * - Authentifier le client lors de la connexion
     * 
     * Processus de connexion:
     * 1. Client rentre son email et mot de passe
     * 2. getClientByEmail() récupère son profil via l'email
     * 3. Vérifier le mot de passe avec password_verify()
     * 4. Si OK → créer une session et connecter le client
     * 
     * @param string $mail - Email du client
     * @return object/array - Infos du client (id, mail, mot_de_passe, etc.) ou null
     */
    public function getClientByEmail($mail){
        $req = $this->bdd->prepare("SELECT * FROM client WHERE mail = :mail");
        $req->bindParam(':mail', $mail);
        $req->execute();
        return $req->fetch();
    }

    
}
?>