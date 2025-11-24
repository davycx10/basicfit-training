<?php

include('../../model/programme/programmeModel.php');
include('../../bdd/bdd.php');

if (isset($_POST['action'])) {

    $programmeController = new ProgrammeController($bdd);

    switch ($_POST['action']) {
        case 'ajouter':
            $programmeController->create();
            break;

        case 'update':
            $programmeController->update();
            break;

        case 'supprimer':
            $programmeController->delete();
            break;

        default:
            header('Location: /fitconnect/index.php?page=programme');
            break;
    }
}

class ProgrammeController {

    private $programme;

    function __construct($bdd) {
        $this->programme = new Programme($bdd);
    }

    public function create() {
        $this->programme->ajouterProgramme(
            $_POST['nom'],
            $_POST['description'],
            $_POST['type']
        );

        header('Location: /fitconnect/index.php?page=programme');
    }

    public function update() {
        $this->programme->modifierProgramme(
            $_POST['id_programme'],
            $_POST['nom'],
            $_POST['description'],
            $_POST['type']
        );

        header('Location: /fitconnect/index.php?page=programme');
    }

    public function delete() {
        $this->programme->supprimerProgramme($_POST['id_programme']);

        header('Location: /fitconnect/index.php?page=programme');
    }
}