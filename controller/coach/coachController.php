<?php

// Inclusion du modèle Coach (contient la logique BDD)
require_once('model/coach/coachModel.php');

/*
  POINT D'ENTRÉE POST:
  - Si un formulaire envoie 'action', on crée le controller et on appelle la méthode correspondante.
  - Chaque case du switch correspond à une action utilisateur (login, update, etc.).
  - $bdd est attendu injecté (venant d'index.php ou d'un bootstrap).
*/
if (isset($_POST['action'])) {

    $coachController = new CoachController($bdd); // $bdd fournie par l'application

    switch ($_POST['action']) {
        case 'connexion': // Connexion: authentifie le coach
            $coachController->login();
            break;

        case 'deconnexion': // Déconnexion: détruit la session
            $coachController->logout();
            break;

        case 'update': // Mise à jour du profil coach
            $coachController->update();
            break;

        case 'supprimer': // Suppression du compte coach
            $coachController->delete();
            break;
            
        case 'accepter_client': // Acceptation d'un client (matching)
            $coachController->accepterClient();
            break;

        default:
            // Action inconnue → redirection vers l'espace coach
            header('Location: index.php?page=espace_coach');
            break;
    }
}

/*
  Classe CoachController
  - Sert d'interface entre les requêtes HTTP et le model Coach.
  - Toutes les méthodes appellent le model pour effectuer les opérations BDD,
    puis redirigent/affichent la vue appropriée.
*/
class CoachController {

    private $coach;

    /*
      Constructeur
      - Reçoit la connexion PDO $bdd et instancie le model Coach.
      - Le model utilisera $bdd pour exécuter les requêtes SQL.
    */
    function __construct($bdd) {
        $this->coach = new Coach($bdd);
    }

    /*
      Méthode login()
      - Récupère email et mot de passe depuis POST.
      - Vérifie le mot de passe avec password_verify().
      - Si valide : initialise les variables de session (id_coach, prenom, role).
      - Si invalide : redirige vers la page de connexion avec un code d'erreur.
    */
    public function login() {
        $mail = trim($_POST['mail']);
        $mdp = trim($_POST['motdepasse']);

        $user = $this->coach->getCoachByEmail($mail);

        if ($user && password_verify($mdp, $user['password'])) {
            // Connexion réussie : création de la session
            $_SESSION['id_coach'] = $user['id'];
            $_SESSION['prenom'] = $user['prenom'];
            $_SESSION['role'] = 'coach'; 

            header('Location: index.php?page=espace_coach');
            exit;
        } else {
            // Gestion des erreurs de connexion
            if (!$user) {
                header('Location: index.php?page=connexion_coach&error=email_inconnu');
            } else {
                header('Location: index.php?page=connexion_coach&error=mdp_faux');
            }
            exit;
        }
    }

    /*
      Méthode logout()
      - Détruit la session en cours et redirige vers la page d'accueil.
    */
    public function logout() {
        session_destroy();
        header('Location: index.php?page=accueil');
        exit;
    }

    /*
      Méthode dashboard()
      - Protège l'accès : vérifie que le coach est connecté (session).
      - Récupère les informations du coach (profil).
      - Récupère les clients compatibles selon la spécialité.
      - Récupère les clients déjà assignés au coach.
      - Charge la vue du tableau de bord (espaceCoach.php).
    */
    public function dashboard() {
        if (!isset($_SESSION['id_coach'])) {
            header('Location: index.php?page=connexion_coach');
            exit;
        }

        $infosCoach = $this->coach->selectById($_SESSION['id_coach']);
        $maSpecialite = $infosCoach['specialite'];

        $clientsEnAttente = $this->coach->getClientsCompatibles($maSpecialite);
        $mesClients = $this->coach->mesClients($_SESSION['id_coach']);

        require('view/coach/espaceCoach.php');
    }
    
    /*
      Méthode accepterClient()
      - Assigne un client au coach.
    */
    public function accepterClient() {
        $this->coach->validerClient($_POST['id_client'], $_SESSION['id_coach']);
        header('Location: index.php?page=espace_coach');
        exit;
    }

    /*
      Méthode update()
      - Met à jour les infos du coach.
    */
    public function update() {
        $this->coach->updateCoach(
            $_POST['id_coach'],
            $_POST['adresse'],
            $_POST['specialite'],
            $_POST['experience'],
            $_POST['linkedin']
        );

        header('Location: index.php?page=espace_coach');
        exit;
    }

    /*
      Méthode delete()
      - Supprime le coach en BDD.
    */
    public function delete() {
        $this->coach->deleteCoach($_POST['id_coach']);
        header('Location: index.php?page=accueil');
        exit;
    }


    
}

?>