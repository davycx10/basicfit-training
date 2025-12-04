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
    // ✅ ÉTAPE 1 : Récupération et nettoyage des données
    $email = trim($_POST['mail']);
    $motdepasse = trim($_POST['motdepasse']);
    $motdepasse_confirm = trim($_POST['motdepasse_confirm']);

    // ✅ ÉTAPE 2 : Vérifier si l'email existe déjà
    if ($this->coach->emailExiste($email)) {
        header('Location: index.php?page=inscription_coach&error=email_existe');
        exit;
    }

    // ✅ ÉTAPE 3 : Validation - les deux mots de passe doivent correspondre
    if ($motdepasse !== $motdepasse_confirm) {
        header('Location: index.php?page=inscription_coach&error=mdp_different');
        exit;
    }

    // ✅ ÉTAPE 4 : Validation - longueur minimale (8 caractères)
    if (strlen($motdepasse) < 8) {
        header('Location: index.php?page=inscription_coach&error=mdp_trop_court');
        exit;
    }

    // ✅ ÉTAPE 5 : Hachage du mot de passe avant insertion
    $mot_de_passe_hash = password_hash($motdepasse, PASSWORD_DEFAULT);

    // ✅ ÉTAPE 6 : Insertion dans la base de données
    $this->coach->ajouterCoach(
        $_POST['nom'],
        $_POST['prenom'],
        $email,
        $_POST['adresse'],
        $_POST['basic_fit'],
        $_POST['specialite'],
        $_POST['cv'],
        $mot_de_passe_hash
    );

    // ✅ ÉTAPE 7 : Redirection vers la page de succès
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
        // ✅ ÉTAPE 1 : Gestion optionnelle du changement de mot de passe
        $mot_de_passe_hash = null;
        
        if (!empty($_POST['motdepasse'])) {
            $motdepasse = trim($_POST['motdepasse']);
            $motdepasse_confirm = trim($_POST['motdepasse_confirm']);

            // Validation
            if ($motdepasse !== $motdepasse_confirm) {
                header('Location: index.php?page=espace_coach&error=mdp_different');
                exit;
            }

            if (strlen($motdepasse) < 8) {
                header('Location: index.php?page=espace_coach&error=mdp_trop_court');
                exit;
            }

            // Hachage du nouveau mot de passe
            $mot_de_passe_hash = password_hash($motdepasse, PASSWORD_DEFAULT);
        }

        $this->coach->modifierCoach(
            $_POST['id_coach'],
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['mail'],
            $_POST['adresse'],
            $_POST['basic_fit'],
            $_POST['specialite'],
            $_POST['cv'],
            $mot_de_passe_hash
        );

        header('Location: index.php?page=espace_coach&message=profil_modifie');
        exit;
    }

    public function delete() {
        $this->coach->supprimerCoach($_POST['id_coach']);
        session_destroy(); // ⬅️ AJOUT : détruire la session après suppression
        header('Location: index.php');
        exit;
    }
}
?>