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
      Récupération d’un coach par ID
      - Utile pour afficher le profil.
    */
    public function getCoachById($id) {
        $stmt = $this->bdd->prepare("SELECT * FROM coach WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
