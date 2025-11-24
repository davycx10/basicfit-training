Je comprends maintenant. Voici ton document avec uniquement les **couleurs** et **polices** modifiées, sans ajout d'usage recommandé ni de CSS. C’est juste une mise à jour simple avec tes nouvelles couleurs et polices.

---

# Charte graphique — Basic-Fit Training / FitConnect

## 1. Identité visuelle

### Palette de couleurs

* **Couleur principale** : #FF5C00 (orange)
* **Couleur secondaire** : #1C1C1C (gris foncé)
* **Couleur complémentaire** : #DEDEDE (gris clair)
* **Couleur d'accent / fond** : #FFFFFF (blanc)

### Typographie

* **Police principale (titres et éléments importants)** : **Bebas Neue**, sans-serif.
* **Police secondaire (corps de texte et descriptions)** : **Poppins**, sans-serif.

---

## 2. Logo et identité

* **Positionnement** : logo en haut à gauche sur toutes les pages web.
* **Versions** : logo complet (header), version symbole (favicon / icône de l'app).
* **Règle** : utiliser le logo sans effets (pas d'ombre ni de dégradé supplémentaires) ; assurer contraste suffisant sur fonds #FF5C00 ou #FFFFFF.

---

## 3. Composants UI — correspondance avec la charte

**Boutons**

* **Primaire** : background #FF5C00, color #FFFFFF, border-radius 8px.
* **Secondaire** : background transparent, border 1px solid rgba(59,59,59,0.12), color #1C1C1C.

**Cartes**

* **Fond** : #DEDEDE, border-radius 8px, padding 16px.
* **Titre** : Bebas Neue 600, color #1C1C1C.

**Header / Navigation**

* **Header** : fond #FFFFFF, texte #1C1C1C, logo à gauche, menu hamburger à droite (mobile).
* **Mobile** : barre de navigation en bas optionnelle avec icônes monochromes #1C1C1C ; icône active en #FF5C00.

**Formulaires**

* **Champs** : fond #FFFFFF ou #DEDEDE, border 1px solid rgba(59,59,59,0.08), placeholder couleur #7A7A7A.
* **Validation** : bordure ou icône en #FF5C00 pour succès / action.

**Tableaux et listes (coach/clients)**

* **En-têtes** : Bebas Neue 600, couleur #1C1C1C.
* **Lignes** : alternance fond #FFFFFF / #DEDEDE pour lisibilité.

**Iconographie**

* **Style** : icônes vectorielles simples, contours propres, monochrome #1C1C1C ; icône active #FF5C00.

---

## 4. Application Java (desktop) — adaptation de la charte

* **Palette et typographie conservées** : adapter Bebas Neue / Poppins via polices embarquées ou équivalentes système.
* **Menu latéral** : fond #FFFFFF, icônes #1C1C1C ; icône ou accent actif en #FF5C00.
* **Boutons et contrôles** : appliquer mêmes règles de couleur et rayon.
* **Tableaux de bord** : cartes avec fond #DEDEDE, graphes et courbes en variations de #FF5C00.
* **Performance** : limiter textures/effets, privilégier rendu vectoriel et transitions légères.

---

## 5. Accessibilité et contraste

* **Vérifier contraste texte/fond** : ratio minimal 4.5:1 pour textes normaux (ex. #1C1C1C sur #FFFFFF satisfait).
* **Proposer réglage taille de police et mode sombre** (fond #1E1E1E ; textes clairs #DEDEDE ; accents en #FF5C00).
* **Tous les éléments cliquables** doivent être accessibles au clavier et avoir des états focus visibles (outline ou box-shadow en #FF5C00 avec faible opacité).

---

## 6. Exemples de pages et mapping

**Page d'accueil (web)**

* Header (logo + menu), section hero avec CTA principal en #FF5C00, sections services en cartes #DEDEDE.

**Dashboard utilisateur**

* En-tête profil (carte), section planning (cartes), zone messages (liste/chat), CTA d'action en #FF5C00.

**Page recherche coach**

* Filtres en colonne ou barre supérieure, résultats en cartes (fond #FFFFFF ou #DEDEDE), boutons d'action en #FF5C00.

**Page chat/suivi**

* Bulles de messages : messages coach en gris clair, messages client en #FF5C00 clair (texte blanc), timestamps en gris foncé.

---

## 7. Livrables graphiques recommandés

* Fichier .sketch/.figma contenant : palette, typographies, composants (boutons, formulaires, cartes), icônes, exemples d'écrans.
* Export SVG des icônes et du logo (symbole et complet).
* Fichier CSS d'exemple avec variables et exemples de composants.

---

## 8. Nom du groupe / marque

* **FitConnect** — conserver cette dénomination pour la communication interne et la documentation produit.

