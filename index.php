<?php 
// ajout du header
include ('view/commun/header.php');

// récupération de la page
$page = isset($_GET['page']) ? $_GET['page'] : 'accueil';

// début du body
echo '<main class="container mt-4">';

switch ($page) {
    case 'accueil':
        include ('view/accueil.php');
        break;

    // partie coach
    case 'listProduit':
        include ('view/produit/listProduit.php'); // <-- corriger le chemin
        break;

    case 'listTypeProduit':
        include ('view/type_produit/listTypeProduit.php');
        break;

    // partie utilisateur
    case 'listUser':
        include ('view/user/listUser.php');
        break;

    case 'addUser':
        include ('view/user/addUser.php');
        break;

    case 'LogInUser':
        include ('view/user/LogInUser.php');
        break;

    default:
        include ('view/accueil.php');
        break;
}
// fin du body
echo '</main>';

// ajout du footer
include ('view/commun/footer.php');
?>
