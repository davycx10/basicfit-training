<!-- // model/programme/programmeModel.php -->


<?php

class Programme {

    private $bdd;

    function __construct($bdd){
        $this->bdd = $bdd;
    }

    // Retourne UN programme correspondant au type fourni.
    // Usage: afficher le détail d'un programme par type (ex: "prise_masse").
    // Paramètre: $type (string) — type du programme.
    // Retour: tableau/objet du programme ou false si aucun.
    public function getProgrammeByType($type) {
        $req = $this->bdd->prepare("SELECT * FROM programme WHERE type = :type");
        $req->bindParam(':type', $type);
        $req->execute();
        return $req->fetch();
    }

    // Récupère TOUS les programmes.
    // Usage: liste admin, affichage catalogue.
    // Retour: tableau de tous les programmes.
    public function allProgramme(){
        $req = $this->bdd->prepare("SELECT * FROM programme");
        $req->execute();
        return $req->fetchAll();
    }

    // Insère un nouveau programme en base.
    // Paramètres: $nom (string), $description (string), $type (string).
    // Retour: bool (true si succès).
    public function ajouterProgramme($nom, $description, $type){
        $req = $this->bdd->prepare("
            INSERT INTO programme (nom, description, type)
            VALUES (:nom, :description, :type)
        ");
        $req->bindParam(':nom', $nom);
        $req->bindParam(':description', $description);
        $req->bindParam(':type', $type);
        return $req->execute();
    }

    // Met à jour un programme existant identifié par son id.
    // Paramètres: $id_programme (int), $nom, $description, $type.
    // Retour: bool (true si la mise à jour a réussi).
    public function modifierProgramme($id_programme, $nom, $description, $type){
        $req = $this->bdd->prepare("
            UPDATE programme
            SET nom = :nom, description = :description, type = :type
            WHERE id_programme = :id_programme
        ");
        $req->bindParam(':id_programme', $id_programme);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':description', $description);
        $req->bindParam(':type', $type);
        return $req->execute();
    }

    // Supprime un programme par son id.
    // Usage: suppression depuis l'interface admin.
    // Paramètre: $id_programme (int).
    // Retour: bool (true si suppression réussie).
    public function supprimerProgramme($id_programme){
        $req = $this->bdd->prepare("DELETE FROM programme WHERE id_programme = :id_programme");
        $req->bindParam(':id_programme', $id_programme);
        return $req->execute();
    }

    // Récupère UN programme par son identifiant.
    // Usage: afficher détail / pré-remplir formulaire d'édition.
    // Paramètre: $id_programme (int).
    // Retour: tableau/objet du programme ou false si inexistant.
    public function selectById($id_programme){
        $req = $this->bdd->prepare("SELECT * FROM programme WHERE id_programme = :id_programme");
        $req->bindParam(':id_programme', $id_programme);
        $req->execute();
        return $req->fetch();
    }
}
?>