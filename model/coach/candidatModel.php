<?php
class Candidat {

    private $bdd;

    public function __construct($bdd) {
        $this->bdd = $bdd;
    }

    /**
     * Ajout d'une candidature dans la table "candidature"
     */
    public function ajouterCandidature($nom, $prenom, $email, $adresse, $basic_fit, $specialite, $experience, $cv_pdf, $linkedin, $password) {

        $stmt = $this->bdd->prepare("
            INSERT INTO candidature 
            (nom, prenom, email, adresse, basic_fit, specialite, experience, cv_pdf, linkedin, password, statut, date_candidature)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'en_attente', NOW())
        ");

        $stmt->execute([
            $nom,
            $prenom,
            $email,
            $adresse,
            $basic_fit,
            $specialite,
            $experience,
            $cv_pdf,
            $linkedin,
            $password
        ]);
    }
}
?>
