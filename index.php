<?php 

include('bdd/bdd.php');

// --- PARTIE 1 : ROUTING DES ACTIONS (POST) ---
if (isset($_POST['action'])) {

    if (isset($_POST['controller'])) {
        
        switch ($_POST['controller']) {
            case 'client':
                include('controller/client/clientController.php');
                break;

            case 'coach':
                include('controller/coach/coachController.php');
                break;

            case 'programme':
                include('controller/programme/programmeController.php');
                break;

            case 'utilisateur':
                include('controller/utilisateur/utilisateurController.php');
                break;
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
            include('view/utilisateur/client/connexionClient.php');
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

    // --- PARTIE PRODUIT (Coach) ---
    // case 'listProduit':
    //     include('view/produit/listProduit.php'); // <-- chemin corrigé
    //     break;

    // case 'listTypeProduit':
    //     include('view/type_produit/listTypeProduit.php');
    //     break;

    // --- PARTIE UTILISATEUR ---
    // case 'listUser':
    //     include('view/user/listUser.php');
    //     break;

    // case 'addUser':
    //     include('view/user/addUser.php');
    //     break;

    // case 'LogInUser':
    //     include('view/user/LogInUser.php');
    //     break;

    // --- PAGE PROGRAMME  ---
    case 'programme':
        include('view/programme/programme.php');
        break;

    // --- ADMINISTRATION ---
    // case 'utilisateur':
    //     include('view/utilisateur/listeUtilisateur.php');
    //     break;

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