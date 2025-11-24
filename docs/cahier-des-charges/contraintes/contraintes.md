# Contraintes du projet FitConnect

## Contraintes fonctionnelles

- L'utilisateur s'inscrit et définit son objectif sportif ainsi que ses disponibilités dès l'inscription (minimum 3 jours, maximum 5 jours, avec 3 créneaux horaires par jour).

- La demande client est automatiquement envoyée aux coachs correspondant à la spécialité choisie.

- Le coach peut accepter ou refuser chaque demande.

- Lorsqu'un coach accepte une demande, le client devient officiellement rattaché à ce coach et disparaît des autres listes de demandes.

- L'administrateur peut valider les coachs, créer leurs comptes, et gérer tous les comptes clients et coachs (consultation, modification, suppression).

## Contraintes techniques

- La base de données suit une architecture relationnelle (`client.id_coach → coach.id_coach`).

- Développement avec PHP, MySQL, HTML et CSS.

- Site responsive, accessible sur ordinateur et mobile.

- Les mots de passe sont sécurisés via hachage côté serveur.

## Contraintes ergonomie et design

- Site simple, intuitif et facile à utiliser pour tout type d'utilisateur.

- Charte graphique cohérente : couleurs Basic-Fit, polices lisibles.

- Informations importantes accessibles rapidement sur les tableaux de bord client et coach.

## Contraintes sécurité

- Les utilisateurs ne peuvent pas accéder aux informations des autres clients ou coachs.

- Les fichiers CV uploadés sont stockés de manière sécurisée.

## Contraintes organisation et projet

- Respect strict de l'architecture MVC pour faciliter la maintenance.

- Code et base de données commentés.

- Chaque action (acceptation de demande, création ou modification de compte) doit être traçable pour l'administrateur.