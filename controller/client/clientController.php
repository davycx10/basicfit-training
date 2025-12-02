<?php

require_once('model/client/clientModel.php');
// Ces modèles sont indispensables pour le dashboard
require_once('model/coach/coachModel.php');
require_once('model/programme/programmeModel.php');

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

    public function create() {
        $mdpHash = password_hash($_POST['motdepasse'], PASSWORD_DEFAULT);

        $this->client->ajouterClient(
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['mail'],
            $mdpHash, 
            $_POST['poids'],
            $_POST['taille'],
            $_POST['basic_fit'],
            $_POST['objectif'],
            // Dispo a été retiré comme demandé
            $_POST['description']
        );

        header('Location: index.php?page=connexion_client');
        exit;
    }


    public function login() {
        $user = $this->client->getClientByEmail($_POST['mail']);

        if ($user && password_verify($_POST['motdepasse'], $user['mot_de_passe'])) {
            
            $_SESSION['id_client'] = $user['id_client'];
            $_SESSION['prenom'] = $user['prenom'];
            $_SESSION['role'] = 'client';

            header('Location: index.php?page=espace_client');
            exit;
        } else {
            header('Location: index.php?page=connexion_client&error=1');
            exit;
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php');
        exit;
    }

    public function dashboard() {
        if (!isset($_SESSION['id_client'])) {
            header('Location: index.php?page=connexion_client');
            exit;
        }

        // 1. Infos Client
        $monProfil = $this->client->selectById($_SESSION['id_client']);

        // 2. Infos Coach (si existe)
        $monCoach = null;
        if ($monProfil['id_coach']) {
            $coachModel = new Coach($this->bdd);
            $monCoach = $coachModel->selectById($monProfil['id_coach']);
        }

        // 3. Infos Programme
        $progModel = new Programme($this->bdd);
        // On récupère le programme qui correspond à l'objectif du client
        $monProgramme = $progModel->getProgrammeByType($monProfil['objectif']);

        require('view/client/espaceClient.php');
    }

    public function update() {
        $this->client->modifierClient(
            $_POST['id_client'],
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['mail'],
            $_POST['motdepasse'],
            $_POST['poids'],
            $_POST['taille'],
            $_POST['basic_fit'],
            $_POST['objectif'],
            $_POST['description']
        );

        header('Location: index.php?page=espace_client');  // Redirige vers le tableau de bord du client (à adapter si nécessaire)
        exit;
    }

    public function delete() {
        $this->client->supprimerClient($_POST['id_client']);
        header('Location: index.php');
        exit;
    }
}
?>