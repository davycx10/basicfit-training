<!-- 
    controller/utilisateur/utilisateurController.php
    Gère les actions liées aux utilisateurs (ajout, modification, suppression) 
-->

<?php

include('../../model/utilisateur/utilisateurModel.php');
include('../../bdd/bdd.php');

/*
 Gestion du point d'entrée POST:
 - Vérifie l'existence de 'action' dans $_POST
 - Crée un contrôleur et appelle la méthode correspondante
*/
if (isset($_POST['action'])) {

    $utilisateurController = new UtilisateurController($bdd);

    switch ($_POST['action']) {
        // Action 'ajouter' -> crée un nouvel utilisateur
        case 'ajouter':
            $utilisateurController->create();
            break;

        // Action 'update' -> met à jour un utilisateur existant
        case 'update':
            $utilisateurController->update();
            break;

        // Action 'supprimer' -> supprime un utilisateur
        case 'supprimer':
            $utilisateurController->delete();
            break;

        // Valeur non reconnue -> redirection vers la liste
        default:
            header('Location: /fitconnect/index.php?page=utilisateur');
            exit;
            break;
    }
}

/*
 Classe UtilisateurController
 - Sert d'interface entre les requêtes HTTP et le model Utilisateur
 - Méthodes: create(), update(), delete()
*/
class UtilisateurController {

    private $utilisateur;

    /*
     Constructeur
     - Reçoit la connexion $bdd (PDO)
     - Instancie le model Utilisateur avec la connexion
    */
    function __construct($bdd) {
        $this->utilisateur = new Utilisateur($bdd);
    }

    /*
     Méthode create()
     - Récupère les champs du formulaire (nom, prenom, mail, motdepasse)
     - Hache le mot de passe avec password_hash() pour sécurité
     - Appelle le model ->ajouterUtilisateur(...) pour insérer en BDD
     - Redirige vers la page utilisateur
     Utilité: traiter l'inscription / ajout d'un utilisateur via POST
    */
    public function create() {

        $mdpHash = password_hash($_POST['motdepasse'], PASSWORD_DEFAULT);

        $this->utilisateur->ajouterUtilisateur(
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['mail'],
            $mdpHash 
        );

        header('Location: /fitconnect/index.php?page=utilisateur');
        exit;
    }

    /*
     Méthode update()
     - Récupère les champs du formulaire (id_utilisateur + nouvelles valeurs)
     - Hache le nouveau mot de passe
     - Appelle le model ->modifierUtilisateur(...) pour mettre à jour la BDD
     - Redirige vers la page utilisateur
     Utilité: traiter la modification d'un utilisateur existant
    */
    public function update() {
        $mdpHash = password_hash($_POST['motdepasse'], PASSWORD_DEFAULT);

        $this->utilisateur->modifierUtilisateur(
            $_POST['id_utilisateur'],
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['mail'],
            $mdpHash
        );

        header('Location: /fitconnect/index.php?page=utilisateur');
        exit;
    }

    /*
     Méthode delete()
     - Récupère l'id_utilisateur depuis $_POST
     - Appelle le model ->supprimerUtilisateur(...) pour supprimer en BDD
     - Redirige vers la page utilisateur
     Utilité: supprimer définitivement un utilisateur (action administrateur)
    */
    public function delete() {
        $this->utilisateur->supprimerUtilisateur($_POST['id_utilisateur']);

        header('Location: /fitconnect/index.php?page=utilisateur');
        exit;
    }
    






}
?>