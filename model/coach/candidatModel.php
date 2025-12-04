<?php
class Candidat {

    private $bdd;

    function __construct($bdd) {
        $this->bdd = $bdd;
    }

    public function ajouterCandidat($nom, $prenom, $mail, $adresse, $basic_fit, $specialite, $experience, $cv, $linkedin, $password) {
        $stmt = $this->bdd->prepare("
            INSERT INTO candidat (nom, prenom, email, adresse, basic_fit, specialite, experience, cv_pdf, linkedin, password, statut, date_candidature)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'en_attente', NOW())
        ");
        $stmt->execute([$nom, $prenom, $mail, $adresse, $basic_fit, $specialite, $experience, $cv, $linkedin, $password]);
    }

    public function validerCandidat($id) {
        $stmt = $this->bdd->prepare("SELECT * FROM candidat WHERE id = ?");
        $stmt->execute([$id]);
        $candidat = $stmt->fetch();

        if ($candidat) {
            $stmtCoach = $this->bdd->prepare("
                INSERT INTO coach (nom, prenom, email, adresse, basic_fit, specialite, experience, cv_pdf, linkedin, password)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmtCoach->execute([
                $candidat['nom'],
                $candidat['prenom'],
                $candidat['email'],
                $candidat['adresse'],
                $candidat['basic_fit'],
                $candidat['specialite'],
                $candidat['experience'],
                $candidat['cv_pdf'],
                $candidat['linkedin'],
                $candidat['password']
            ]);

            $stmtDel = $this->bdd->prepare("UPDATE candidat SET statut = 'valide' WHERE id = ?");
            $stmtDel->execute([$id]);
        }
    }

    public function refuserCandidat($id) {
        $stmt = $this->bdd->prepare("UPDATE candidat SET statut = 'refuse' WHERE id = ?");
        $stmt->execute([$id]);
    }

    //  Suppression automatique des candidats expirés
    public function supprimerCandidatsExpirés() {
        // Supprimer les refusés après 15 jours
        $stmt = $this->bdd->prepare("
            DELETE FROM candidat 
            WHERE statut = 'refuse' 
            AND date_candidature < NOW() - INTERVAL 15 DAY
        ");
        $stmt->execute();

        // Supprimer les validés après 15 jours (déjà transférés dans coach)
        $stmt2 = $this->bdd->prepare("
            DELETE FROM candidat 
            WHERE statut = 'valide' 
            AND date_candidature < NOW() - INTERVAL 15 DAY
        ");
        $stmt2->execute();
    }

}
?> 