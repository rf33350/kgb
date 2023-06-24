<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="assets/css/kgbstyle.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <title>KGB</title>
</head>
<body>
    <div class="container">
        <header class="header-space d-flex flex-wrap align-items-center justify-content-center justify-content-md-around py-3 mb-4 border-bottom">
        <div class="col-md-3 mb-2 mb-md-0">
            <a href="index.php?controller=page&action=home" class="d-inline-flex link-body-emphasis text-decoration-none">
            <img src="assets/images/logo_KGB.png" width="60px" alt="logo kgb">
            </a>
        </div>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="index.php?controller=page&action=home" class="nav-link px-2">Accueil</a></li>
            <li><a href="index.php?controller=mission&action=list" class="nav-link px-2">Missions</a></li>
            <?php 
                if (isset($_SESSION['user'])) {
                    echo '
                    <li><a href="index.php?controller=target&action=list" class="nav-link px-2">Cibles</a></li>
                    <li><a href="index.php?controller=contact&action=list" class="nav-link px-2">Contacts</a></li>
                    <li><a href="index.php?controller=hideout&action=list" class="nav-link px-2">Planques</a></li>
                    <li><a href="index.php?controller=agent&action=list" class="nav-link px-2">Agents</a></li>
                    ';
                }
            ?>
        </ul>

        <div class="col-md-3 text-end">
            <?php 
                if (!isset($_SESSION['user'])) {
                    echo '<a href="index.php?controller=auth&action=login"><button type="button" class="btn btn-outline-primary me-2">Se connecter</button></a>';
                } else {
                    echo '<a href="index.php?controller=auth&action=logout"><button type="button" class="btn btn-outline-primary me-2">Se déconnecter</button></a>';
                }
                
            ?>
        </div>
        </header>
        

        <main>