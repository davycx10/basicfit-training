<?php
require_once('model/coach/candidatModel.php');

if (isset($_POST['action'])) {
    $candidatController = new CandidatController($bdd);

    switch ($_POST['action']) {
        case 'ajouter':
            $candidatController->create();
            break;

        case 'valider':
            $candidatController->valider($_POST['id']);
            break;

        case 'refuser':
            $candidatController->refuser($_POST['id']);
            break;

        case 'nettoyer': //  Suppression automatique en fonction du statut
            $candidatController->nettoyerCandidats();
            break;

        default:
            header('Location: index.php?page=accueil');
            break;
    }
}

class CandidatController {

    private $candidat;

    function __construct($bdd) {
        $this->candidat = new Candidat($bdd);
    }

    public function create() {

        $cvFile = $_FILES['cv']['name']; // Récupération du nom du fichier CV
        $cvPath = "uploads/cv/" . basename($cvFile); // Chemin de destination pour le CV
        move_uploaded_file($_FILES['cv']['tmp_name'], $cvPath); // Déplacement du fichier téléchargé

        $this->candidat->ajouterCandidat(
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['mail'],
            $_POST['adresse'],
            $_POST['basic_fit'],
            $_POST['specialite'],
            $_POST['experience'],
            $cvPath,
            $_POST['linkedin'],
            $_POST['password'],
            
        );

        echo "<script>alert('Merci pour votre candidature, nous reviendrons vers vous dans les plus brefs délais.');</script>";
        header('Refresh:0; url=index.php?page=accueil');
        exit;
    }

    public function valider($id) {
        $this->candidat->validerCandidat($id);
        header('Location: index.php?page=admin&message=candidature_validee');
        exit;
    }

    public function refuser($id) {
        $this->candidat->refuserCandidat($id);
        header('Location: index.php?page=admin&message=candidature_refusee');
        exit;
    }

    //  Nettoyage automatique des candidats selon statut et date
    public function nettoyerCandidats() {
        $this->candidat->supprimerCandidatsExpirés();
        header('Location: index.php?page=admin&message=candidats_nettoyes');
        exit;
    }
}
