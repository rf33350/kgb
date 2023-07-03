<?php 
    require_once _ROOTPATH_.'/templates/header.php'; 
    require_once _ROOTPATH_.'/templates/redirect.php'; 
?>

<div class="text-center">
    <h1>Modification du contact</h1>
</div>

<form action="index.php?controller=contact&action=update&id=<?php echo $contact->getId(); ?>" method="POST" class="form">


    <input type="hidden" name="contactId" value="<?php echo $contact->getID(); ?>">

    <div class="form-group">
        <label for="firstName">Prénom :</label>
        <input type="text" name="firstName" id="firstName" value="<?php echo $contact->getFirstName(); ?>" required class="form-control">
    </div>

    <div class="form-group">
        <label for="lastName">Nom :</label>
        <input type="text" name="lastName" id="lastName" value="<?php echo $contact->getLastName(); ?>" required class="form-control">
    </div>

    <div class="form-group">
        <label for="birthDate">Date de naissance :</label>
        <input type="date" name="birthDate" id="birthDate" value="<?php echo $contact->getBirthDate()->format('Y-m-d'); ?>" required class="form-control">
    </div>

    <div class="form-group">
        <label for="code">Code :</label>
        <input type="number" name="code" id="code" value="<?php echo $contact->getCode(); ?>" required class="form-control">
    </div>

    <div class="form-group">
        <label for="nationality">Nationalité :</label>
        <input type="text" name="nationality" id="nationality" value="<?php echo $contact->getNationality(); ?>" required class="form-control">
    </div>

    <br>

    <input type="submit" value="Mettre à jour" class="btn btn-primary">
</form>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>
