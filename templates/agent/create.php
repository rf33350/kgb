<?php require_once _ROOTPATH_.'/templates/header.php'; ?>

<div class="text-center">
    <h1>Création d'un agent</h1>
</div>

<form action="index.php?controller=agent&action=create" method="POST" class="form">
    <input type="hidden" name="createAgent">

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

    <div class="form-group">
        <label for="specialities[]">Spécialité 1 :</label>
        <select name="specialities[]" id="specialities" class="form-control">
            <option value="">Sélectionnez une spécialité</option>
            <?php foreach ($specialities as $speciality) : ?>
                <option value="<?php echo $speciality->getId(); ?>"><?php echo $speciality->getTitle(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="specialities[]">Spécialité 2 :</label>
        <select name="specialities[]" id="specialities" class="form-control">
            <option value="">Sélectionnez une spécialité</option>
            <?php foreach ($specialities as $speciality) : ;?>
                
                <option value="<?php echo $speciality->getId(); ?>"><?php echo $speciality->getTitle(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <br>
    <input type="submit" value="Créer agent" class="btn btn-primary">
</form>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>
