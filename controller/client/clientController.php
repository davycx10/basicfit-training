
<?php
    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);


    // session_start();

    include(__DIR__ . '/../../bdd/bdd.php');

    require_once(__DIR__ . '/../../model/client/clientModel.php');
    require_once(__DIR__ . '/../../model/coach/coachModel.php');
    require_once(__DIR__ . '/../../model/programme/programmeModel.php');


    if (isset($_POST['action'])) {

        $clientController = new ClientController($bdd);

        switch ($_POST['action']) {
            case 'ajouter': 
                $clientController->create();
                break;

            case 'connexion': 
                $clientController->login();
                break;

            case 'deconnexion': 
                $clientController->logout();
                break;

            case 'update':
                $clientController->update();
                break;

            case 'supprimer':
                $clientController->delete();
                break;

            default:
                header('Location: index.php?page=espace_client');
                break;
        }
    }

class ClientController {

    private $client;
    private $bdd;

    function __construct($bdd) {
        $this->bdd = $bdd;
        $this->client = new Client($bdd);
    }

    /*
      create()
      - Inscription d’un nouveau client
      - Hashage du mot de passe
      - Insertion via clientModel
    */
    public function create() {

        // Hash du mot de passe
        $mdpHash = password_hash($_POST['motdepasse'], PASSWORD_BCRYPT);

        // Créneau horaire (time picker)
        $dispo_creneaux = $_POST['creneau_debut'] . "-" . $_POST['creneau_fin'];

        // Jours disponibles (checkboxes)
        $dispo_jours = null;
        if (!empty($_POST['dispo_jours'])) {
            $dispo_jours = implode(",", $_POST['dispo_jours']);
        }

        // Insertion dans la BDD
        $this->client->ajouterClient(
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['mail'],
            $mdpHash,            // mot de passe hashé
            $_POST['poids'],
            $_POST['taille'],
            $_POST['genre'],
            $_POST['basic_fit'],
            $_POST['objectif'],
            $dispo_jours,        // 🔥 ordre correct
            $dispo_creneaux,     // 🔥 ordre correct
            $_POST['motivation'] // 🔥 ordre correct
        );

        header('Location: http://localhost/basicfit-training/index.php?page=connexion_client');
        exit;
    }


    /*
      login()
      - Authentifie un client avec email + mot de passe
      - Vérifie le hash avec password_verify
    */
    public function login() {
        $user = $this->client->getClientByEmail($_POST['mail']);

        if ($user && password_verify($_POST['motdepasse'], $user['mot_de_passe'])) {
            $_SESSION['id_client'] = $user['id_client'];
            $_SESSION['prenom'] = $user['prenom'];
            $_SESSION['role'] = 'client';

            header('Location: http://localhost/basicfit-training/index.php?page=espace_client');
            exit;
        } else {
            header('Location: http://localhost/basicfit-training/index.php?page=connexion_client&error=1');
            exit;
        }
    }

    /*
      logout()
      - Déconnecte le client
    */
    public function logout() {
        // Vider le tableau $_SESSION
        $_SESSION = [];

        // Supprimer le cookie de session côté client
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Détruire la session côté serveur
        session_destroy();

            // echo '<div class="alert custom-alert alert-dismissible fade show" role="alert">
            //         Vous êtes déconnecté.
            //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            //     </div>';

        // Redirection vers l'accueil
        header('Location: http://localhost/basicfit-training/index.php?page=accueil');
        exit();
    }


    /*
      dashboard()
      - Charge les infos client, coach associé et programme
    */
    public function dashboard() {
        if (!isset($_SESSION['id_client'])) {
            header('Location: http://localhost/basicfit-training/index.php?page=connexion_client');
            exit;
        }

        $monProfil = $this->client->selectById($_SESSION['id_client']);

        $monCoach = null;
        if (!empty($monProfil['id_coach'])) {
            $coachModel = new Coach($this->bdd);
            $monCoach = $coachModel->getCoachById($monProfil['id_coach']);
        }

        $progModel = new Programme($this->bdd);
        $monProgramme = $progModel->getProgrammeByType($monProfil['objectif']);

        require('view/client/espaceClient.php');
    }

    /*
      update()
      - Met à jour les infos du client
      - Hashage du mot de passe si modifié
    */
    public function update() {
        $mdpHash = password_hash($_POST['motdepasse'], PASSWORD_BCRYPT);

        $this->client->modifierClient(
            $_POST['id_client'],
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['mail'],
            $mdpHash,
            $_POST['poids'],
            $_POST['taille'],
            $_POST['genre'],       
            $_POST['basic_fit'],
            $_POST['objectif'],
            $_POST['motivation']
        );

        header('Location: index.php?page=espace_client');
        exit;
    }

    /*
      delete()
      - Supprime le client
    */
    public function delete() {
        $this->client->supprimerClient($_POST['id_client']);
        header('Location: index.php?page=accueil');
        exit;
    }
    
}
?>
