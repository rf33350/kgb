<?php require_once _ROOTPATH_.'/templates/header.php'; ?>

<div class="text-center">
    <h1>Modification de la cible</h1>
</div>

<form action="index.php?controller=target&action=update&id=<?php echo $cible->getId(); ?>" method="POST" class="form">


    <input type="hidden" name="targetId" value="<?php echo $cible->getID(); ?>">

    <div class="form-group">
        <label for="firstName">Prénom :</label>
        <input type="text" name="firstName" id="firstName" value="<?php echo $cible->getFirstName(); ?>" required class="form-control">
    </div>

    <div class="form-group">
        <label for="lastName">Nom :</label>
        <input type="text" name="lastName" id="lastName" value="<?php echo $cible->getLastName(); ?>" required class="form-control">
    </div>

    <div class="form-group">
        <label for="birthDate">Date de naissance :</label>
        <input type="date" name="birthDate" id="birthDate" value="<?php echo $cible->getBirthDate()->format('Y-m-d'); ?>" required class="form-control">
    </div>

    <div class="form-group">
        <label for="code">Code :</label>
        <input type="number" name="code" id="code" value="<?php echo $cible->getCode(); ?>" required class="form-control">
    </div>

    <div class="form-group">
        <label for="nationality">Nationalité :</label>
        <input type="text" name="nationality" id="nationality" value="<?php echo $cible->getNationality(); ?>" required class="form-control">
    </div>

    <br>

    <input type="submit" value="Mettre à jour" class="btn btn-primary">
</form>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>
