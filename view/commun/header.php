<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link rel="stylesheet" href="css/commun/header.css">
<link rel="stylesheet" href="css/style.css">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <!-- Logo texte -->
                <a class="navbar-brand fw-bold" href="/">Basic Fit</a>

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

                        <!-- Menu Coach avec sous-menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="coachDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-badge"></i> Coach
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="coachDropdown">
                                <li><a class="dropdown-item" href="index.php?page=inscriptionCoach"><i class="bi bi-person-plus"></i> Inscription Coach</a></li>
                                <li><a class="dropdown-item" href="index.php?page=connexionCoach"><i class="bi bi-box-arrow-in-right"></i> Connexion Coach</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="index.php?page=espaceCoach"><i class="bi bi-person-workspace"></i> Espace Coach</a></li>
                                <li><a class="dropdown-item" href="index.php?page=mesClients"><i class="bi bi-people"></i> Mes Clients</a></li>
                            </ul>
                        </li>

                        <!-- Menu Client avec sous-menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="clientDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person"></i> Client
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="clientDropdown">
                                <li><a class="dropdown-item" href="index.php?page=inscriptionClient"><i class="bi bi-person-plus"></i> Inscription Client</a></li>
                                <li><a class="dropdown-item" href="index.php?page=connexionClient"><i class="bi bi-box-arrow-in-right"></i> Connexion Client</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="index.php?page=espaceClient"><i class="bi bi-person-workspace"></i> Espace Client</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>



    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
