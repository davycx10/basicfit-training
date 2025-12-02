<!-- // controller/coach/coachController.php
// Gère les actions liées aux coachs (inscription, connexion, gestion profil, matching clients) -->

<?php

// Inclusion du Modèle
require_once('model/coach/coachModel.php');

// GESTION DES REQUÊTES POST (Action)
if (isset($_POST['action'])) {

    $coachController = new CoachController($bdd); // $bdd vient de index.php

    switch ($_POST['action']) {
        case 'ajouter': // Candidature
            $coachController->create();
            break;

        case 'connexion': // Login
            $coachController->login();
            break;

        case 'deconnexion': // Logout
            $coachController->logout();
            break;

        case 'update': // Mise à jour profil
            $coachController->update();
            break;

        case 'supprimer': // Supprimer compte
            $coachController->delete();
            break;
            
        case 'accepter_client': // Matching
            $coachController->accepterClient();
            break;

        default:
            header('Location: index.php?page=espace_coach');
            break;
    }
}

class CoachController {

    private $coach;

    function __construct($bdd) {
        $this->coach = new Coach($bdd);
    }

    public function create() {
        $this->coach->ajouterCoach(
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['mail'],
            $_POST['adresse'],
            $_POST['basic_fit'],
            $_POST['specialite'],
            $_POST['cv']
        );

        header('Location: index.php?page=accueil&message=candidature_envoyee');
        exit;
    }

    public function login() {
        $mail = trim($_POST['mail']);
        $mdp = trim($_POST['motdepasse']);

        $user = $this->coach->getCoachByEmail($mail);

        if ($user && password_verify($mdp, $user['mot_de_passe'])) {
            
            $_SESSION['id_coach'] = $user['id_coach'];
            $_SESSION['prenom'] = $user['prenom'];
            $_SESSION['role'] = 'coach'; 

            header('Location: index.php?page=espace_coach');
            exit;
        } else {
            // Gestion des erreurs
            if (!$user) {
                header('Location: index.php?page=connexion_coach&error=email_inconnu');
            } else {
                header('Location: index.php?page=connexion_coach&error=mdp_faux');
            }
            exit;
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php');
        exit;
    }

    public function dashboard() {
        // Sécurité
        if (!isset($_SESSION['id_coach'])) {
            header('Location: index.php?page=connexion_coach');
            exit;
        }

        // Récupération des infos du coach
        $infosCoach = $this->coach->selectById($_SESSION['id_coach']);
        $maSpecialite = $infosCoach['specialite'];

        // Matching : Clients en attente
        $clientsEnAttente = $this->coach->getClientsCompatibles($maSpecialite);

        // Clients déjà validés
        $mesClients = $this->coach->mesClients($_SESSION['id_coach']);

        // Affichage de la vue
        require('view/coach/espaceCoach.php');
    }
    
    public function accepterClient() {
        $this->coach->validerClient($_POST['id_client'], $_SESSION['id_coach']);
        
        header('Location: index.php?page=espace_coach');
        exit;
    }

    public function update() {
        $this->coach->modifierCoach(
            $_POST['id_coach'],
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['mail'],
            $_POST['adresse'],
            $_POST['basic_fit'],
            $_POST['specialite'],
            $_POST['cv']
        );

        header('Location: index.php?page=espace_coach');
        exit;
    }

    public function delete() {
        $this->coach->supprimerCoach($_POST['id_coach']);

        header('Location: index.php');
        exit;
    }
}
?>