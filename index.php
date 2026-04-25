<?php
session_start();
require_once 'config.php';

// Récupérer les filières pour le formulaire
$stmt = $pdo->query("SELECT * FROM filieres ORDER BY nom");
$filieres = $stmt->fetchAll();

// Récupérer les étudiants avec leurs filières
$stmt = $pdo->query("
    SELECT e.*, f.nom as filiere_nom 
    FROM etudiants e 
    LEFT JOIN filieres f ON e.filiere_id = f.id 
    ORDER BY e.nom, e.prenom
");
$etudiants = $stmt->fetchAll();

// Afficher les erreurs s'il y en a
if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
    echo '<div class="message error">';
    foreach($_SESSION['errors'] as $error) {
        echo '<p>' . htmlspecialchars($error) . '</p>';
    }
    echo '</div>';
    
    // Nettoyer les erreurs après affichage
    unset($_SESSION['errors']);
    unset($_SESSION['old_data']);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Étudiants</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Gestion des Étudiants</h1>
            <p>Application de gestion des étudiants et de leurs filières</p>
        </header>

        <section class="section">
            <h2>Ajouter un étudiant</h2>
            <form id="addForm" action="traitement.php" method="POST">
                <div class="form-group">
                    <label for="nom">Nom *</label>
                    <input type="text" id="nom" name="nom" class="form-control" 
                           value="<?= isset($_SESSION['old_data']['nom']) ? htmlspecialchars($_SESSION['old_data']['nom']) : '' ?>" 
                           required>
                </div>
                
                <div class="form-group">
                    <label for="prenom">Prénom *</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" 
                           value="<?= isset($_SESSION['old_data']['prenom']) ? htmlspecialchars($_SESSION['old_data']['prenom']) : '' ?>" 
                           required>
                </div>
                
                <div class="form-group">
                    <label for="filiere_id">Filière *</label>
                    <select id="filiere_id" name="filiere_id" class="form-control" required>
                        <option value="">Sélectionnez une filière</option>
                        <?php foreach($filieres as $filiere): ?>
                            <option value="<?= $filiere['id'] ?>" 
                                <?= (isset($_SESSION['old_data']['filiere_id']) && $_SESSION['old_data']['filiere_id'] == $filiere['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($filiere['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <button type="submit" class="btn">Ajouter l'étudiant</button>
            </form>
        </section>

        <section class="section">
            <h2>Liste des étudiants</h2>
            
            <?php 
            // Afficher les messages de succès/erreur
            if (isset($_GET['success'])) {
                $messages = [
                    1 => 'Étudiant ajouté avec succès !',
                    2 => 'Étudiant modifié avec succès !',
                    3 => 'Étudiant supprimé avec succès !'
                ];
                if (isset($messages[$_GET['success']])) {
                    echo '<div class="message success">' . $messages[$_GET['success']] . '</div>';
                }
            }
            
            if (isset($_GET['error'])) {
                echo '<div class="message error">Erreur lors de l\'opération. Veuillez réessayer.</div>';
            }
            ?>
            
            <?php if (count($etudiants) > 0): ?>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Filière</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($etudiants as $etudiant): ?>
                                <tr>
                                    <td><?= htmlspecialchars($etudiant['nom']) ?></td>
                                    <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
                                    <td><?= htmlspecialchars($etudiant['filiere_nom']) ?></td>
                                    <td>
                                        <div class="actions">
                                            <a href="update.php?id=<?= $etudiant['id'] ?>" class="btn btn-secondary">Modifier</a>
                                            <a href="delete.php?id=<?= $etudiant['id'] ?>" class="btn btn-danger delete-link">Supprimer</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p>Aucun étudiant enregistré pour le moment.</p>
            <?php endif; ?>
        </section>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>