<?php
class Coach {

    private $bdd;

    public function __construct($bdd) {
        $this->bdd = $bdd;
    }

    /*
      Authentification du coach
      - Vérifie si l'email existe et compare le mot de passe saisi avec le hash en base.
      - Retourne les infos du coach si connexion réussie.
    */
    public function login($email, $password) {
        $stmt = $this->bdd->prepare("SELECT * FROM coach WHERE email = ?");
        $stmt->execute([$email]);
        $coach = $stmt->fetch();

        if ($coach && password_verify($password, $coach['password'])) {
            return $coach; // Authentification réussie
        }
        return false; // Échec
    }

    /*
      Récupération d’un coach par email
      - Utilisé par le controller pour la connexion.
    */
    public function getCoachByEmail($mail) {
        $stmt = $this->bdd->prepare("SELECT * FROM coach WHERE email = ?");
        $stmt->execute([$mail]);
        return $stmt->fetch();
    }

    /*
      Récupération d’un coach par ID
      - Utile pour afficher le profil / dashboard.
    */
    public function getCoachById($id) {
        $stmt = $this->bdd->prepare("SELECT * FROM coach WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Alias pour coller à ce que le controller appelle: selectById()
    public function selectById($id) {
        return $this->getCoachById($id);
    }

    /*
      Mise à jour du profil coach
      - Permet de modifier les infos personnelles (adresse, spécialité, etc.).
    */
    public function updateCoach($id, $adresse, $specialite, $experience, $linkedin) {
        $stmt = $this->bdd->prepare("
            UPDATE coach 
            SET adresse = ?, specialite = ?, experience = ?, linkedin = ?
            WHERE id = ?
        ");
        $stmt->execute([$adresse, $specialite, $experience, $linkedin, $id]);
    }

    /*
      Suppression d’un coach
      - Supprime le coach de la table.
    */
    public function deleteCoach($id) {
        $stmt = $this->bdd->prepare("DELETE FROM coach WHERE id = ?");
        $stmt->execute([$id]);
    }

    /*
      Clients compatibles avec la spécialité du coach
      - Objectif du client = spécialité du coach
      - Client sans coach (id_coach IS NULL)
    */
    public function getClientsCompatibles($specialite) {
        $sql = "
            SELECT * 
            FROM client
            WHERE objectif = ?
              AND id_coach IS NULL
        ";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute([$specialite]);
        return $stmt->fetchAll();
    }

    /*
      Clients déjà assignés à un coach
    */
    public function mesClients($id_coach) {
        $sql = "
            SELECT * 
            FROM client
            WHERE id_coach = ?
        ";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute([$id_coach]);
        return $stmt->fetchAll();
    }

    /*
      Valider / accepter un client
      - Assigne le client au coach.
    */
    public function validerClient($id_client, $id_coach) {
        $sql = "
            UPDATE client
            SET id_coach = ?
            WHERE id_client = ?
        ";
        $stmt = $this->bdd->prepare($sql);
        return $stmt->execute([$id_coach, $id_client]);
    }
}
