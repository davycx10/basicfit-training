<!-- // model/coach/coachModel.php -->


<?php

class Coach {

    private $bdd;

    function __construct($bdd){
        $this->bdd = $bdd;
    }

    public function allCoach(){
        $req = $this->bdd->prepare("SELECT * FROM coach");
        $req->execute();
        return $req->fetchAll();
    }

    // J'ai ajouté basic_fit dans la requête INSERT (c'était manquant)
    public function ajouterCoach($nom, $prenom, $mail, $adresse, $basic_fit, $specialite, $cv){
        $req = $this->bdd->prepare("
            INSERT INTO coach (nom, prenom, mail, adresse, basic_fit, specialite, cv)
            VALUES (:nom, :prenom, :mail, :adresse, :basic_fit, :specialite, :cv)
        ");
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':mail', $mail);
        $req->bindParam(':adresse', $adresse);
        $req->bindParam(':basic_fit', $basic_fit);
        $req->bindParam(':specialite', $specialite);
        $req->bindParam(':cv', $cv);
        return $req->execute();
    }

    // J'ai ajouté basic_fit dans la requête UPDATE (c'était manquant)
    public function modifierCoach($id_coach, $nom, $prenom, $mail, $adresse, $basic_fit, $specialite, $cv){
        $req = $this->bdd->prepare("
            UPDATE coach 
            SET nom = :nom, prenom = :prenom, mail = :mail, adresse = :adresse, 
                basic_fit = :basic_fit, specialite = :specialite, cv = :cv
            WHERE id_coach = :id_coach
        ");
        $req->bindParam(':id_coach', $id_coach);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':mail', $mail);
        $req->bindParam(':adresse', $adresse);
        $req->bindParam(':basic_fit', $basic_fit);
        $req->bindParam(':specialite', $specialite);
        $req->bindParam(':cv', $cv);
        return $req->execute();
    }

    public function supprimerCoach($id_coach){
        $req = $this->bdd->prepare("DELETE FROM coach WHERE id_coach = :id_coach");
        $req->bindParam(':id_coach', $id_coach);
        return $req->execute();
    }

    public function selectById($id_coach){
        $req = $this->bdd->prepare("SELECT * FROM coach WHERE id_coach = :id_coach");
        $req->bindParam(':id_coach', $id_coach);
        $req->execute();
        return $req->fetch();
    }



    // 1. Pour la connexion (C'est celle qui plantait)
    public function getCoachByEmail($mail){
        $req = $this->bdd->prepare("SELECT * FROM coach WHERE mail = :mail");
        $req->bindParam(':mail', $mail);
        $req->execute();
        return $req->fetch();
    }

    // 2. Pour le Matching (Indispensable pour le dashboard)
    public function getClientsCompatibles($specialite){
        $req = $this->bdd->prepare("SELECT * FROM client WHERE objectif = :specialite AND id_coach IS NULL");
        $req->bindParam(':specialite', $specialite);
        $req->execute();
        return $req->fetchAll();
    }

    // 3. Pour voir ses clients actuels
    public function mesClients($id_coach){
        $req = $this->bdd->prepare("SELECT * FROM client WHERE id_coach = :id_coach");
        $req->bindParam(':id_coach', $id_coach);
        $req->execute();
        return $req->fetchAll();
    }

    // 4. Pour valider un client
    public function validerClient($id_client, $id_coach){
        $req = $this->bdd->prepare("UPDATE client SET id_coach = :id_coach WHERE id_client = :id_client");
        $req->bindParam(':id_client', $id_client);
        $req->bindParam(':id_coach', $id_coach);
        return $req->execute();
    }
}
?>