
<section class="form-section" > <div class="form-card">
        <h2>Espace Coach</h2>
        <p style="text-align: center; font-size: 0.9em; margin-bottom: 20px;">Accès réservé aux professionnels agréés</p>

        <?php if(isset($_SESSION['error']) && $_SESSION['error']): ?>
            <div class="alert-error">
                Identifiants incorrects. Vérifiez votre email et votre mot de passe.
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>



        <form action="index.php" method="POST">
            
            <input type="hidden" name="controller" value="coach">
            <input type="hidden" name="action" value="connexion">

            <div class="form-group">
                <label>Email :</label>
                <input type="email" name="mail" class="form-input" placeholder="coach@basic-fit.fr" required>
            </div>

            <div class="form-group">
                <label>Mot de passe :</label>
                <input type="password" name="motdepasse" class="form-input" required>
            </div>

            <button type="submit" class="btn btn-primary full-width">Connexion</button>
        </form>

        <div class="form-footer">
            <p>Pas encore coach ? <a href="index.php?page=inscription_coach">Postuler ici</a></p>
        </div>
    </div>
</section>