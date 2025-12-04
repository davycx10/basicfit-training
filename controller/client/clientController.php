<?php

    session_start();

     include('../../bdd/bdd.php');

    require_once('../../model/client/clientModel.php');
    require_once('../../model/coach/coachModel.php');
    require_once('../../model/programme/programmeModel.php');

    if (isset($_POST['action'])) {

        $clientController = new ClientController($bdd);

        switch ($_POST['action']) {
            case 'ajouter': 
                $clientController->create();
                break;

            case 'connexion': 
                $clientController->login();
                break;

            case 'deconnexion': 
                $clientController->logout();
                break;

            case 'update':
                $clientController->update();
                break;

            case 'supprimer':
                $clientController->delete();
                break;

            default:
                header('Location: index.php?page=espace_client');
                break;
        }
    }

class ClientController {

    private $client;
    private $bdd;

    function __construct($bdd) {
        $this->bdd = $bdd;
        $this->client = new Client($bdd);
    }

    /*
      create()
      - Inscription d’un nouveau client
      - Hashage du mot de passe
      - Insertion via clientModel
    */
    public function create() {
        // $mdpHash = password_hash($_POST['motdepasse'], PASSWORD_BCRYPT);
        $this->client->ajouterClient(
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['mail'],
            $_POST['motdepasse'],   // mot de passe brut du formulaire
            $_POST['poids'],
            $_POST['taille'],
            $_POST['genre'],
            $_POST['basic_fit'],
            $_POST['objectif'],
            $_POST['motivation']
        );

         echo "<script>alert('Vous avez bien été inscrit, mtn connecter vous .');</script>";
        // var_dump("Client ajouté avec succès.");

        header('Location: http://localhost/basicfit-training/index.php?page=connexion_client');
        exit;
    }

    /*
      login()
      - Authentifie un client avec email + mot de passe
      - Vérifie le hash avec password_verify
    */
    public function login() {
        $user = $this->client->getClientByEmail($_POST['mail']);

        if ($user && password_verify($_POST['motdepasse'], $user['mot_de_passe'])) {
            $_SESSION['id_client'] = $user['id_client'];
            $_SESSION['prenom'] = $user['prenom'];
            $_SESSION['role'] = 'client';

            header('Location: http://localhost/basicfit-training/index.php?page=espace_client');
            exit;
        } else {
            header('Location: http://localhost/basicfit-training/index.php?page=connexion_client&error=1');
            exit;
        }
    }

    /*
      logout()
      - Déconnecte le client
    */
    public function logout() {
        session_destroy();
        header('Location: http://localhost/basicfit-training/index.php?page=accueil');
        exit;
    }

    /*
      dashboard()
      - Charge les infos client, coach associé et programme
    */
    public function dashboard() {
        if (!isset($_SESSION['id_client'])) {
            header('Location: http://localhost/basicfit-training/index.php?page=connexion_client');
            exit;
        }

        $monProfil = $this->client->selectById($_SESSION['id_client']);

        $monCoach = null;
        if (!empty($monProfil['id_coach'])) {
            $coachModel = new Coach($this->bdd);
            $monCoach = $coachModel->selectById($monProfil['id_coach']);
        }

        $progModel = new Programme($this->bdd);
        $monProgramme = $progModel->getProgrammeByType($monProfil['objectif']);

        require('view/client/espaceClient.php');
    }

    /*
      update()
      - Met à jour les infos du client
      - Hashage du mot de passe si modifié
    */
    public function update() {
        $mdpHash = password_hash($_POST['motdepasse'], PASSWORD_BCRYPT);

        $this->client->modifierClient(
            $_POST['id_client'],
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['mail'],
            $mdpHash,
            $_POST['poids'],
            $_POST['taille'],
            $_POST['genre'],       // 🔥 ajouté
            $_POST['basic_fit'],
            $_POST['objectif'],
            $_POST['motivation']
        );

        header('Location: index.php?page=espace_client');
        exit;
    }

    /*
      delete()
      - Supprime le client
    */
    public function delete() {
        $this->client->supprimerClient($_POST['id_client']);
        header('Location: index.php?page=accueil');
        exit;
    }
    
}
?>