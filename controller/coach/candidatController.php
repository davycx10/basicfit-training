<?php

    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);

    
    include(__DIR__ . '/../../bdd/bdd.php');
    require_once(__DIR__ . '/../../model/coach/candidatModel.php');

if (isset($_POST['action'])) {
    $controller = new CandidatController($bdd);

    switch ($_POST['action']) {
        case 'ajouter':
            $controller->create();
            break;

        default:
            header('Location: index.php?page=accueil');
            exit;
    }
}

class CandidatController {

    private $candidat;

    public function __construct($bdd) {
        $this->candidat = new Candidat($bdd);
    }

    public function create() {

        /* -----------------------------
           1. Upload du CV PDF
        ------------------------------*/
        if (!isset($_FILES['cv_pdf']) || $_FILES['cv_pdf']['error'] !== 0) {
            die("Erreur lors de l'upload du CV.");
        }

        $cvName = time() . "_" . basename($_FILES['cv_pdf']['name']);
        $cvPath = __DIR__ . '/../../uploads/cv/' . $cvName;

        move_uploaded_file($_FILES['cv_pdf']['tmp_name'], $cvPath);

        /* -----------------------------
           2. Hash du mot de passe
        ------------------------------*/
        // $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        /* -----------------------------
           3. Insertion en BDD
        ------------------------------*/
        $this->candidat->ajouterCandidature(
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['adresse'],
            $_POST['basic_fit'],
            $_POST['specialite'],
            $_POST['experience'],
            $cvPath,
            $_POST['linkedin'],
            $_POST['password'] // Stockage en clair (à éviter en production !)
        );

        /* -----------------------------
           4. Message + redirection
        ------------------------------*/
    echo "<script>
        alert('Merci pour votre candidature ! Un administrateur l\'examinera prochainement.');
        window.location.href = '../../index.php?page=accueil';
    </script>";
    exit;
    }
}
