<?php
require_once 'config.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et valider les données
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $filiere_id = $_POST['filiere_id'] ?? '';
    
    // Validation simple côté serveur
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
    
    // Si pas d'erreurs, insérer dans la base
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO etudiants (nom, prenom, filiere_id) VALUES (?, ?, ?)");
            $stmt->execute([$nom, $prenom, $filiere_id]);
            
            // Redirection avec message de succès
            header('Location: index.php?success=1');
            exit;
        } catch(PDOException $e) {
            $errors[] = "Erreur lors de l'insertion : " . $e->getMessage();
        }
    }
    
    // Si erreurs, les stocker en session pour les afficher
    if (!empty($errors)) {
        session_start();
        $_SESSION['errors'] = $errors;
        $_SESSION['old_data'] = [
            'nom' => $nom,
            'prenom' => $prenom,
            'filiere_id' => $filiere_id
        ];
        header('Location: index.php');
        exit;
    }
} else {
    // Si accès direct, rediriger vers l'index
    header('Location: index.php');
    exit;
}
?>