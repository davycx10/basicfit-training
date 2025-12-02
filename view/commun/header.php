<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitConnect - Basic-Fit Training</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/commun/header.css">
    <link rel="stylesheet" href="css/commun/footer.css">
    <link rel="stylesheet" href="css/client/client.css">
    <link rel="stylesheet" href="css/coach/coach.css">
    <link rel="stylesheet" href="css/sectionHero/sectionHero.css">
    <link rel="stylesheet" href="css/programme/programme.css">
    <link rel="stylesheet" href="css/style.css">


    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            
            <!-- Logo FitConnect -->
            <a class="navbar-brand fw-bold" href="index.php">
                Fit<span>Connect</span>
            </a>

            <!-- Bouton burger pour mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu principal -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">

                    <!-- Menu Accueil -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=accueil"><i class="bi bi-house"></i> Accueil</a>
                    </li>

                    <!-- Menu Programmes -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=programme"><i class="bi bi-list-task"></i> Nos Programmes</a>
                    </li>

                    <!-- Menu Coach avec sous-menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="coachDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-badge"></i> Coach
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="coachDropdown">
                            <li><a class="dropdown-item" href="index.php?page=inscription_coach"><i class="bi bi-person-plus"></i> Inscription Coach</a></li>
                            <li><a class="dropdown-item" href="index.php?page=connexion_coach"><i class="bi bi-box-arrow-in-right"></i> Connexion Coach</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.php?page=espace_coach"><i class="bi bi-person-workspace"></i> Espace Coach</a></li>
                        </ul>
                    </li>

                    <!-- Menu Client avec sous-menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="clientDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person"></i> Client
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="clientDropdown">
                            <li><a class="dropdown-item" href="index.php?page=inscription_client"><i class="bi bi-person-plus"></i> Inscription Client</a></li>
                            <li><a class="dropdown-item" href="index.php?page=connexion_client"><i class="bi bi-box-arrow-in-right"></i> Connexion Client</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.php?page=espace_client"><i class="bi bi-person-workspace"></i> Espace Client</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- Partie droite : affichage utilisateur connecté -->
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'client'): ?>
                        <li class="nav-item">
                            <span class="navbar-text text-white">Bonjour, <?= htmlspecialchars($_SESSION['prenom']) ?></span>
                        </li>
                        <li class="nav-item">
                            <form action="index.php" method="POST" class="d-inline">
                                <input type="hidden" name="controller" value="client">
                                <input type="hidden" name="action" value="deconnexion">
                                <button type="submit" class="btn btn-outline-light ms-2"><i class="bi bi-box-arrow-left"></i> Déconnexion</button>
                            </form>
                        </li>

                    <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'coach'): ?>
                        <li class="nav-item">
                            <span class="navbar-text text-white">Coach <?= htmlspecialchars($_SESSION['prenom']) ?></span>
                        </li>
                        <li class="nav-item">
                            <form action="index.php" method="POST" class="d-inline">
                                <input type="hidden" name="controller" value="coach">
                                <input type="hidden" name="action" value="deconnexion">
                                <button type="submit" class="btn btn-outline-light ms-2"><i class="bi bi-box-arrow-left"></i> Déconnexion</button>
                            </form>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
