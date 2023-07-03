<?php 
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Redirigez l'utilisateur vers la page d'accueil
    header('Location: http://localhost/kgb/index.php?controller=page&action=home');
    exit();
}
?>