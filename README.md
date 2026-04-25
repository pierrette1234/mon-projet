# Gestion des Étudiants

Application web de gestion des étudiants développée avec PHP, MySQL, HTML, CSS et JavaScript.

## Fonctionnalités

- Ajouter un étudiant
- Afficher la liste des étudiants
- Modifier les informations d'un étudiant
- Supprimer un étudiant
- Validation JavaScript côté client
- Validation PHP côté serveur
- Interface responsive et moderne

## Structure du projet

```
Gestion_etudiants/
├── index.php          # Page principale avec formulaire et liste
├── traitement.php     # Traitement de l'ajout d'étudiant
├── update.php         # Modification d'un étudiant
├── delete.php         # Suppression d'un étudiant
├── config.php         # Configuration de la base de données
├── database.sql       # Script SQL pour créer la base
├── README.md          # Documentation
└── assets/
    ├── css/
    │   └── style.css  # Styles CSS
    └── js/
        └── script.js  # Scripts JavaScript
```

## Installation

### 1. Prérequis
- Serveur web (Apache, Nginx, etc.)
- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Git

### 2. Configuration de la base de données

1. Exécuter le script SQL `database.sql` dans MySQL :
```bash
mysql -u root -p < database.sql
```

2. Modifier les informations de connexion dans `config.php` :
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'gestion_etudiants');
define('DB_USER', 'root');
define('DB_PASS', '');
```

### 3. Déploiement

1. Copier le dossier du projet dans le répertoire web de votre serveur
2. Assurez-vous que PHP a les permissions d'écriture nécessaires
3. Accédez à l'application via votre navigateur

## Utilisation

### Ajouter un étudiant
1. Remplir le formulaire sur la page d'accueil
2. Cliquer sur "Ajouter l'étudiant"
3. La validation JavaScript empêche l'envoi si les champs sont vides

### Modifier un étudiant
1. Cliquer sur "Modifier" dans la liste des étudiants
2. Modifier les informations dans le formulaire
3. Cliquer sur "Mettre à jour"

### Supprimer un étudiant
1. Cliquer sur "Supprimer" dans la liste des étudiants
2. Confirmer la suppression dans la boîte de dialogue JavaScript

## Technologies utilisées

- **Frontend** : HTML5, CSS3, JavaScript (ES6+)
- **Backend** : PHP 7.4+, PDO pour la base de données
- **Base de données** : MySQL avec relations entre tables
- **Versionning** : Git avec GitHub
- **Style** : CSS moderne avec gradients et animations

## Sécurité

- Utilisation de PDO avec requêtes préparées pour éviter les injections SQL
- Échappement des sorties avec `htmlspecialchars()`
- Validation côté client et serveur
- Protection contre les attaques XSS

## Développement

### Branches Git
- `main` : Branche de production
- `develop` : Branche de développement

### Workflow Git
```bash
# Créer une branche de fonctionnalité
git checkout -b feature/nouvelle-fonctionnalite

# Fusionner dans develop
git checkout develop
git merge feature/nouvelle-fonctionnalite

# Fusionner dans main
git checkout main
git merge develop
```

## Auteurs

Développé dans le cadre d'un TP de révision.

## Licence

Ce projet est open-source et disponible sous licence MIT.