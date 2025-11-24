<?php

include('../../model/client/clientModel.php');
include('../../bdd/bdd.php');

if (isset($_POST['action'])) {

    $clientController = new ClientController($bdd);

    switch ($_POST['action']) {
        case 'ajouter':
            $clientController->create();
            break;

        case 'update':
            $clientController->update();
            break;

        case 'supprimer':
            $clientController->delete();
            break;

        default:
            header('Location: /fitconnect/index.php?page=client');
            break;
    }
}

class ClientController {

    private $client;

    function __construct($bdd) {
        $this->client = new Client($bdd);
    }

    public function create() {
        $this->client->ajouterClient(
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['mail'],
            $_POST['mdp'],
            $_POST['poids'],
            $_POST['taille'],
            $_POST['basic_fit'],
            $_POST['objectif'],
            $_POST['dispo'],
            $_POST['description']
        );

        header('Location: /fitconnect/index.php?page=client');
    }

    public function update() {
        $this->client->modifierClient(
            $_POST['id_client'],
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['mail'],
            $_POST['mdp'],
            $_POST['poids'],
            $_POST['taille'],
            $_POST['basic_fit'],
            $_POST['objectif'],
            $_POST['dispo'],
            $_POST['description']
        );

        header('Location: /fitconnect/index.php?page=client');
    }

    public function delete() {
        $this->client->supprimerClient($_POST['id_client']);

        header('Location: /fitconnect/index.php?page=client');
    }
}
