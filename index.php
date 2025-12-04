<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include('bdd/bdd.php');

// --- PARTIE 1 : ROUTING DES ACTIONS (POST) ---
if (isset($_POST['action'])) {

    if (isset($_POST['controller'])) {
        
        switch ($_POST['controller']) {
            case 'client':
                include('controller/client/clientController.php');
                break;

            case 'candidat':
                include('controller/coach/candidatController.php');
                break;

            case 'coach':
                include('controller/coach/coachController.php');
                break;

            case 'programme':
                include('controller/programme/programmeController.php');
                break;

            // case 'utilisateur':
            //     include('controller/utilisateur/utilisateurController.php');
            //     break;
        }
    }
}



// --- PARTIE 2 : ROUTING DES PAGES (GET) ---


// ajout du header
// include ('view/commun/header.php');

// --- PARTIE 2 : ROUTING DES VUES (GET) ---
include('view/commun/header.php');

// début du body
echo '<main class="container mt-4">';

// récupération de la page demandée
$page = isset($_GET['page']) ? $_GET['page'] : 'accueil';

switch ($page) {

    // --- ACCUEIL ---
    case 'accueil':
        include('view/accueil/accueil.php');
        break;

    // --- ESPACE CLIENT ---
    case 'inscription_client':
        include('view/utilisateur/client/inscriptionClient.php');
        break;

    case 'connexion_client':
        include('view/utilisateur/client/connexionClient.php');
        break;

    case 'espace_client':
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'client') {
            // ON PASSE PAR LE CONTROLEUR 
            include('controller/client/clientController.php');
            $clientController = new ClientController($bdd);
            $clientController->dashboard();
        } else {
            include('view/utilisateurclient/connexionClient.php');
        }
        break;

    // --- ESPACE COACH ---
    case 'inscription_coach':
        include('view/utilisateur/coach/inscriptionCoach.php');
        break;

    case 'connexion_coach':
        include('view/utilisateur/coach/connexionCoach.php');
        break;

    case 'espace_coach':
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'coach') {
            // ON PASSE PAR LE CONTROLEUR
            include('controller/coach/coachController.php');
            $coachController = new CoachController($bdd);
            $coachController->dashboard();
        } else {
            include('view/utilisateur/coach/connexionCoach.php');
        }
        break;



    // --- PAGE PROGRAMME  ---
    case 'programme':
        include('view/programme/programme.php');
        break;



    // --- PAR DÉFAUT : ACCUEIL ---
    default:
        include('view/accueil/accueil.php');
        break;
}

// fin du body
echo '</main>';
// ajout du footer
include ('view/commun/footer.php');
?>