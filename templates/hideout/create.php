<?php require_once _ROOTPATH_.'/templates/header.php'; ?>

<div class="text-center">
    <h1>Création d'une planque</h1>
</div>

<form action="index.php?controller=hideout&action=create" method="POST" class="form">
    <input type="hidden" name="createHideout">

    <div class="form-group">
        <label for="address">Adresse :</label>
        <input type="text" name="address" id="address" required class="form-control">
    </div>

    <div class="form-group">
        <label for="country">Pays :</label>
        <input type="text" name="country" id="country" required class="form-control">
    </div>


    <div class="form-group">
        <label for="code">Code :</label>
        <input type="number" name="code" id="code" required class="form-control">
    </div>


    <br>

    <input type="submit" value="Créer planque" class="btn btn-primary">
</form>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>
