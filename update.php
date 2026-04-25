<?php
require_once 'config.php';

// Vérifier si l'ID est présent
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

// Récupérer les données de l'étudiant
$stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id = ?");
$stmt->execute([$id]);
$etudiant = $stmt->fetch();

// Vérifier si l'étudiant existe
if (!$etudiant) {
    header('Location: index.php');
    exit;
}

// Récupérer les filières
$stmt = $pdo->query("SELECT * FROM filieres ORDER BY nom");
$filieres = $stmt->fetchAll();

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $filiere_id = $_POST['filiere_id'] ?? '';
    
    $errors = [];
    
    if (empty($nom)) {
        $errors[] = "Le nom est requis";
    }
    
    if (empty($prenom)) {
        $errors[] = "Le prénom est requis";
    }
    
    if (empty($filiere_id) || !is_numeric($filiere_id)) {
        $errors[] = "Veuillez sélectionner une filière valide";
    }
    
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("UPDATE etudiants SET nom = ?, prenom = ?, filiere_id = ? WHERE id = ?");
            $stmt->execute([$nom, $prenom, $filiere_id, $id]);
            
            header('Location: index.php?success=2');
            exit;
        } catch(PDOException $e) {
            $errors[] = "Erreur lors de la modification : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un étudiant</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Modifier un étudiant</h1>
            <p>Modification des informations de l'étudiant</p>
        </header>

        <section class="section">
            <a href="index.php" class="btn btn-secondary" style="margin-bottom: 20px;">← Retour à la liste</a>
            
            <h2>Modifier les informations</h2>
            
            <?php if (isset($errors) && !empty($errors)): ?>
                <div class="message error">
                    <?php foreach($errors as $error): ?>
                        <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <form id="updateForm" method="POST">
                <div class="form-group">
                    <label for="nom">Nom *</label>
                    <input type="text" id="nom" name="nom" class="form-control" 
                           value="<?= htmlspecialchars($etudiant['nom']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="prenom">Prénom *</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" 
                           value="<?= htmlspecialchars($etudiant['prenom']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="filiere_id">Filière *</label>
                    <select id="filiere_id" name="filiere_id" class="form-control" required>
                        <option value="">Sélectionnez une filière</option>
                        <?php foreach($filieres as $filiere): ?>
                            <option value="<?= $filiere['id'] ?>" 
                                <?= $filiere['id'] == $etudiant['filiere_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($filiere['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-success">Mettre à jour</button>
                <a href="index.php" class="btn btn-secondary">Annuler</a>
            </form>
        </section>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>