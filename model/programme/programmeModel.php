<!-- // model/programme/programmeModel.php -->


<?php

class Programme {

    private $bdd;

    function __construct($bdd){
        $this->bdd = $bdd;
    }

    // --- LA FONCTION QUI MANQUAIT (Celle qui cause l'erreur) ---
    public function getProgrammeByType($type) {
        $req = $this->bdd->prepare("SELECT * FROM programme WHERE type = :type");
        $req->bindParam(':type', $type);
        $req->execute();
        return $req->fetch();
    }

    // --- TES ANCIENNES FONCTIONS (CRUD ADMIN) ---
    
    public function allProgramme(){
        $req = $this->bdd->prepare("SELECT * FROM programme");
        $req->execute();
        return $req->fetchAll();
    }

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

    public function supprimerProgramme($id_programme){
        $req = $this->bdd->prepare("DELETE FROM programme WHERE id_programme = :id_programme");
        $req->bindParam(':id_programme', $id_programme);
        return $req->execute();
    }

    public function selectById($id_programme){
        $req = $this->bdd->prepare("SELECT * FROM programme WHERE id_programme = :id_programme");
        $req->bindParam(':id_programme', $id_programme);
        $req->execute();
        return $req->fetch();
    }
}
?>