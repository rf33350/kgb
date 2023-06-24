<?php require_once _ROOTPATH_.'/templates/header.php'; ?>

<div class="text-center">
    <h1>Modification de l'agent</h1>
</div>

<form action="index.php?controller=agent&action=update&id=<?php echo $agent->getId(); ?>" method="POST" class="form">


    <input type="hidden" name="agentId" value="<?php echo $agent->getID(); ?>">

    <div class="form-group">
        <label for="firstName">Prénom :</label>
        <input type="text" name="firstName" id="firstName" value="<?php echo $agent->getFirstName(); ?>" required class="form-control">
    </div>

    <div class="form-group">
        <label for="lastName">Nom :</label>
        <input type="text" name="lastName" id="lastName" value="<?php echo $agent->getLastName(); ?>" required class="form-control">
    </div>

    <div class="form-group">
        <label for="birthDate">Date de naissance :</label>
        <input type="date" name="birthDate" id="birthDate" value="<?php echo $agent->getBirthDate()->format('Y-m-d'); ?>" required class="form-control">
    </div>

    <div class="form-group">
        <label for="code">Code :</label>
        <input type="number" name="code" id="code" value="<?php echo $agent->getCode(); ?>" required class="form-control">
    </div>

    <div class="form-group">
        <label for="nationality">Nationalité :</label>
        <input type="text" name="nationality" id="nationality" value="<?php echo $agent->getNationality(); ?>" required class="form-control">
    </div>

    <?php foreach ($agentSpecialities as $key => $agentSpeciality) : ?>
        
        <div class="form-group">
        <label for="specialities[]">Spécialité <?php echo ($key+1); ?> :</label>
        <select name="specialities[]" id="specialities" class="form-control">
            <option value=""><?php echo $agentSpeciality->getTitle() ; ?></option>
            <?php foreach ($specialities as $speciality) : ?>
                <option value="<?php echo $speciality->getId(); ?>"><?php echo $speciality->getTitle(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>        
    <?php endforeach; ?>

    <br>

    <input type="submit" value="Mettre à jour" class="btn btn-primary">
</form>

<br>
<br>
<a href="index.php?controller=agent&action=list" class="btn btn-primary">Retour à la liste</a>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>
