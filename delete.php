<?php
require_once 'config.php';

// Vérifier si l'ID est présent
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

// Vérifier si l'étudiant existe
$stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id = ?");
$stmt->execute([$id]);
$etudiant = $stmt->fetch();

if (!$etudiant) {
    header('Location: index.php');
    exit;
}

// Supprimer l'étudiant
try {
    $stmt = $pdo->prepare("DELETE FROM etudiants WHERE id = ?");
    $stmt->execute([$id]);
    
    header('Location: index.php?success=3');
    exit;
} catch(PDOException $e) {
    // En cas d'erreur, rediriger avec un message d'erreur
    header('Location: index.php?error=1');
    exit;
}
?>