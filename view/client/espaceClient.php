<div class="container padding-container">
    
    <div class="dashboard-welcome">
        <div class="welcome-text">
            <h1>Ravi de vous revoir, <?= htmlspecialchars($_SESSION['prenom']) ?> !</h1>
            <p>Prêt à vous dépasser aujourd'hui ? Voici votre suivi.</p>
        </div>
        <div class="welcome-icon">⚡</div>
    </div>

    <div class="stats-container">
        <div class="stat-card">
            <span class="stat-icon">🎯</span>
            <div class="stat-info">
                <span class="stat-label">Objectif</span>
                <span class="stat-value orange"><?= htmlspecialchars($monProfil['objectif']) ?></span>
            </div>
        </div>
        <div class="stat-card">
            <span class="stat-icon">⚖️</span>
            <div class="stat-info">
                <span class="stat-label">Poids actuel</span>
                <span class="stat-value"><?= htmlspecialchars($monProfil['poids']) ?> kg</span>
            </div>
        </div>
        <div class="stat-card">
            <span class="stat-icon">📏</span>
            <div class="stat-info">
                <span class="stat-label">Taille</span>
                <span class="stat-value"><?= htmlspecialchars($monProfil['taille']) ?> cm</span>
            </div>
        </div>
    </div>

    <div class="dashboard-split-row">
        
        <div class="card dashboard-card coach-section">
            <h3>👟 Mon Coach</h3>
            <?php if ($monCoach): ?>
                <div class="coach-profile-horizontal">
                    <div class="avatar-circle">
                        <?= strtoupper(substr($monCoach['prenom'], 0, 1)) . strtoupper(substr($monCoach['nom'], 0, 1)) ?>
                    </div>
                    <div class="coach-details">
                        <h4><?= htmlspecialchars($monCoach['prenom']) ?> <?= htmlspecialchars($monCoach['nom']) ?></h4>
                        <a href="mailto:<?= htmlspecialchars($monCoach['mail']) ?>" class="btn-text">Envoyer un email →</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="coach-searching-small">
                    <span class="pulse-icon-small">⏳</span>
                    <div>
                        <strong>Recherche en cours</strong>
                        <p>Nous cherchons le meilleur expert.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>


    </div>
        <div class="card dashboard-card programme-large"> 
            <div class="card-header-clean"> 
                <h3> Mon Programme Détaillé</h3> 
                <?php 
                if ($monProgramme): ?> 
                <span class="badge orange"><?= htmlspecialchars($monProgramme['nom']) ?>
            </span> <?php endif; 
            ?> 
            </div> 
            <?php if ($monCoach && $monProgramme): ?> 
                <div class="programme-content overflow-auto"> 
                    <div class="row g-4"> <?= $monProgramme['description'] ?> 
                </div> 
            </div> <?php else: ?>

        <script>
document.addEventListener("DOMContentLoaded", function () {
    const container = document.querySelector(".programme-content");
    if (!container) return;

    const elements = Array.from(container.children);
    const newGrid = document.createElement("div");
    newGrid.className = "row g-4";

    let currentCard = null;

    elements.forEach(el => {
        if (el.tagName === "H4") {
            // Nouvelle card
            currentCard = document.createElement("div");
            currentCard.className = "col-lg-6 col-md-12";
            currentCard.innerHTML = `
                <div class="card p-3 shadow-sm">
                    <h4 style="color:#fe7000; font-weight:bold;">${el.innerHTML}</h4>
                    <div class="card-body-content"></div>
                </div>
            `;
            newGrid.appendChild(currentCard);
        } else if (currentCard) {
            // Ajouter le contenu dans la card
            currentCard.querySelector(".card-body-content").appendChild(el);
        }
    });

    // Remplacer l'ancien contenu par la grille
    container.innerHTML = "";
    container.appendChild(newGrid);
});
</script>

            





            <div class="locked-zone-large">
                <div class="lock-circle">🔒</div>
                <h3>Programme Verrouillé</h3>
                <p>Votre coach est en train de personnaliser votre plan d'entraînement. Revenez vite !</p>
            </div>
        <?php endif; ?>
    </div>

</div>