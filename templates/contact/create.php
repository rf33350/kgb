<?php require_once _ROOTPATH_.'/templates/header.php'; ?>

<div class="text-center">
    <h1>Création d'un contact</h1>
</div>

<form action="index.php?controller=contact&action=create" method="POST" class="form">
    <input type="hidden" name="createContact">

    <div class="form-group">
        <label for="firstName">Prénom :</label>
        <input type="text" name="firstName" id="firstName" required class="form-control">
    </div>

    <div class="form-group">
        <label for="lastName">Nom :</label>
        <input type="text" name="lastName" id="lastName" required class="form-control">
    </div>

    <div class="form-group">
        <label for="birthDate">Date de naissance :</label>
        <input type="date" name="birthDate" id="birthDate" required class="form-control">
    </div>

    <div class="form-group">
        <label for="code">Code :</label>
        <input type="number" name="code" id="code" required class="form-control">
    </div>

    <div class="form-group">
        <label for="nationality">Nationalité :</label>
        <input type="text" name="nationality" id="nationality" required class="form-control">
    </div>

    <br>

    <input type="submit" value="Créer contact" class="btn btn-primary">
</form>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>
