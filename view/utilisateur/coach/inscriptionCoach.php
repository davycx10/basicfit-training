<section class="form-section" style="background-color: #eee;">
    <div class="form-card" style="max-width: 600px; border-top: 5px solid #333;">
        <h2 style="color: #333;">Candidature Coach</h2>
        <p style="text-align:center; color:#666; margin-bottom:20px;">
            Rejoignez l'élite Basic-Fit Training. Votre candidature sera examinée par un administrateur.
        </p>

        <form action="controller/coach/candidatController.php" method="POST">
            
            <input type="hidden" name="controller" value="candidat">
            <input type="hidden" name="action" value="ajouter">

            <div style="display: flex; gap: 15px;">
                <div class="form-group" style="flex: 1;">
                    <label>Nom :</label>
                    <input type="text" name="nom" class="form-input" placeholder="Entrez votre nom" required>
                </div>

                <div class="form-group" style="flex: 1;">
                    <label>Prénom :</label>
                    <input type="text" name="prenom" class="form-input" placeholder="Entrez votre prénom" required>
                </div>
            </div>

            <div class="form-group">
                <label>Email pro :</label>
                <input type="email" name="mail" class="form-input" placeholder="Entrez votre email professionnel" required>
            </div>

            <div class="form-group">
                <label>Adresse Postale :</label>
                <input type="text" name="adresse" class="form-input" placeholder="Ville, Code Postal..." required>
            </div>

            <div class="form-group">
                <label>Êtes-vous coach en salle Basic-Fit ?</label>
                <select name="basic_fit" class="form-input">
                    <option value="1">Oui, j'exerce déjà en salle</option>
                    <option value="0">Non, je suis externe</option>
                </select>
            </div>

            <div class="form-group">
                <label>Votre Spécialité (Expertise) :</label>
                <select name="specialite" class="form-input">
                    <option value="prise_masse">Prise de Masse (Hypertrophie)</option>
                    <option value="seche">Sèche & Perte de poids</option>
                    <option value="remise_forme">Remise en Forme & Cardio</option>
                </select>
            </div>

            <div class="form-group">
                <label>Experience </label>
                <input type="number" name="experience" class="form-input" placeholder="Entrez votre nombre d'années d'expérience en tant que coach" required>
            </div>



            <div class="form-group">
                <label>Votre CV en pdf  :</label>
                <input type="file" name="cv" class="form-input" accept=".pdf" required>
            </div>

            <div class="form-group">
                <label> Votre profil Linkedin ou Portfolio :</label>
                <input type="text" name="linkedin" class="form-input" placeholder="lien de votre profil Linkedin ou Portfolio" required>
            </div>


            <div class="form-group">
                <label>Mot de passe :</label>
                <input type="password" name="motdepasse" class="form-input" placeholder="Entrez un mot de passe" required>
            </div>

            <button type="submit" class="btn btn-primary full-width" style="background-color: #333; border-color: #333;">Envoyer ma candidature</button>
        </form>

        <div class="form-footer">
            <p>Déjà membre de l'équipe ? <a href="index.php?page=connexioncoach" style="color:#333;">Accès Espace Pro</a></p>
        </div>
    </div>
</section>