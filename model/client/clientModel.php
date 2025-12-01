<?php

class Client {

    private $bdd;

    function __construct($bdd){
        $this->bdd = $bdd;
    }

    public function allClient(){
        $req = $this->bdd->prepare("SELECT * FROM client");
        $req->execute();
        return $req->fetchAll();
    }

    public function ajouterClient($nom, $prenom, $mail, $mdp, $poids, $taille, $basic_fit, $objectif, $description){
        // Attention à bien mettre la description dans la colonne 'motivation' si c'est le nom dans ta BDD
        $req = $this->bdd->prepare("
            INSERT INTO client 
            (nom, prenom, mail, mot_de_passe, poids, taille, basic_fit, objectif, motivation)
            VALUES 
            (:nom, :prenom, :mail, :mdp, :poids, :taille, :basic_fit, :objectif, :description)
        ");

        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':mail', $mail);
        $req->bindParam(':mdp', $mdp);
        $req->bindParam(':poids', $poids);
        $req->bindParam(':taille', $taille);
        $req->bindParam(':basic_fit', $basic_fit);
        $req->bindParam(':objectif', $objectif);
        $req->bindParam(':description', $description);

        return $req->execute();
    }

    public function modifierClient($id_client, $nom, $prenom, $mail, $mdp, $poids, $taille, $basic_fit, $objectif,
        $description){
        $req = $this->bdd->prepare("
            UPDATE client
            SET nom = :nom, prenom = :prenom, mail = :mail, mot_de_passe = :mdp,
                poids = :poids, taille = :taille, basic_fit = :basic_fit, objectif = :objectif,
                motivation = :description
            WHERE id_client = :id_client
        ");

        $req->bindParam(':id_client', $id_client);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':mail', $mail);
        $req->bindParam(':mdp', $mdp);
        $req->bindParam(':poids', $poids);
        $req->bindParam(':taille', $taille);
        $req->bindParam(':basic_fit', $basic_fit);
        $req->bindParam(':objectif', $objectif);
        $req->bindParam(':description', $description);

        return $req->execute();
    }

    public function supprimerClient($id_client){
        $req = $this->bdd->prepare("DELETE FROM client WHERE id_client = :id_client");
        $req->bindParam(':id_client', $id_client);
        return $req->execute();
    }

    public function selectById($id_client){
        $req = $this->bdd->prepare("SELECT * FROM client WHERE id_client = :id_client");
        $req->bindParam(':id_client', $id_client);
        $req->execute();
        return $req->fetch();
    }

    // FONCTION INDISPENSABLE POUR LA CONNEXION
    public function getClientByEmail($mail){
        $req = $this->bdd->prepare("SELECT * FROM client WHERE mail = :mail");
        $req->bindParam(':mail', $mail);
        $req->execute();
        return $req->fetch();
    }
}
?>