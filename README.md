# Matcha Bloom — Site Vitrine 🍵

Bienvenue dans le projet **Matcha Bloom**, un site vitrine minimaliste et élégant conçu pour un salon de thé spécialisé dans les boissons à base de matcha. Ce projet fictif vise à mettre en avant une approche éco-conçue en utilisant Symfony et Tailwind CSS.

## 🎯 Objectifs du Projet
- Présenter le salon de thé et son ambiance unique
- Afficher une carte des boissons et plats disponibles
- Proposer un formulaire de contact simple et efficace
- Respecter les bonnes pratiques d'éco-conception pour un site performant et accessible

---

## ⚙️ Technologies Utilisées

### Backend
- **Symfony** : Framework PHP robuste pour la gestion des routes, des contrôleurs et des formulaires.

### Frontend
- **Tailwind CSS** : Framework CSS utilitaire pour une personnalisation rapide et cohérente du design.

### Autres
- **Twig** : Template engine pour le rendu dynamique des pages.
- **Doctrine (facultatif)** : Pour une éventuelle gestion de base de données.
- **PostCSS** : Préprocesseur CSS pour optimiser les styles.

---

## 🌿 Engagement Éco-Conception
Ce site respecte les principes suivants :
1. **Optimisation des assets** :
   - Utilisation de Tailwind CSS en purgeant les classes inutilisées.
   - Compression des images et fichiers statiques.
2. **Minimisation des requêtes HTTP** :
   - Groupement et minimisation des assets.
3. **Accessibilité** :
   - Respect des standards WCAG pour une meilleure expérience utilisateur.
4. **Éco-performance** :
   - Optimisation des temps de chargement et réduction de l'empreinte carbone numérique.

---

## 📂 Structure du Projet
```
MatchaBloom/
├── assets/       # Fichiers CSS et JS
├── config/       # Configuration de Symfony
├── public/       # Fichiers accessibles au public (images, index.php)
├── src/          # Code source (Contrôleurs, Entités, Services)
├── templates/    # Fichiers Twig pour les vues
├── .env          # Variables d'environnement
└── README.md     # Documentation
```

---

## 🌐 Fonctionnalités
- **Page d'accueil** : Présentation du salon et de ses spécialités
- **Page Menu** : Affichage de la carte des boissons et plats
- **Page Le Salon** : Histoire et ambiance du salon
- **Page Contact** : Formulaire de contact et informations pratiques
- **Mentions légales**

---

## 🔧 Installation et Lancement
1. Cloner ce dépôt :
   ```bash
   git clone <url-du-repo>
   cd MatchaBloom
   ```

2. Installer les dépendances PHP :
   ```bash
   composer install
   ```

3. Installer les dépendances frontend :
   ```bash
   npm install
   ```

4. Compiler les fichiers CSS avec Tailwind :
   ```bash
   npm run build
   ```

5. Lancer le serveur de développement :
   ```bash
   symfony server:start
   ```

6. Accéder au site sur [http://localhost:8000](http://localhost:8000)

---

## 🚀 Améliorations Futures
- Ajout d'une gestion des réservations
- Inclusion d'une galerie dynamique
- Accessibilité renforcée (ARIA et navigation clavier)

---

## 💚 Remerciements
Merci de contribuer à un web plus respectueux de l'environnement en respectant les principes de l'éco-conception !
