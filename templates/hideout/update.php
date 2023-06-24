<?php require_once _ROOTPATH_.'/templates/header.php'; ?>

<div class="text-center">
    <h1>Modification de la planque</h1>
</div>

<form action="index.php?controller=hideout&action=update&id=<?php echo $planque->getId(); ?>" method="POST" class="form">

    <input type="hidden" name="hideoutId" value="<?php echo $planque->getID(); ?>">

    <div class="form-group">
        <label for="address">Adresse :</label>
        <input type="text" name="address" id="address" value="<?php echo $planque->getAddress(); ?>" required class="form-control">
    </div>

    <div class="form-group">
        <label for="country">Pays :</label>
        <input type="text" name="country" id="country" value="<?php echo $planque->getCountry(); ?>" required class="form-control">
    </div>


    <div class="form-group">
        <label for="code">Code :</label>
        <input type="number" name="code" id="code" value="<?php echo $planque->getCode(); ?>" required class="form-control">
    </div>

    <br>

    <input type="submit" value="Mettre à jour" class="btn btn-primary">
</form>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>
