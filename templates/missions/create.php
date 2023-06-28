<?php require_once _ROOTPATH_.'/templates/header.php'; ?>

<div class="text-center">
    <h1>Création d'une nouvelle mission</h1>
</div>

<form action="index.php?controller=mission&action=create" method="POST" class="form">
    <input type="hidden" name="createMission">

    <div class="form-group">
        <label for="title">Titre :</label>
        <input type="text" name="title" id="title" required class="form-control">
    </div>

    <div class="form-group">
        <label for="description">Description :</label>
        <input type="text" name="description" id="description" required class="form-control">
    </div>

    <div class="form-group">
        <label for="codeName">Nom de code :</label>
        <input type="text" name="codeName" id="codeName" required class="form-control">
    </div>

    <div class="form-group">
        <label for="country">Pays :</label>
        <input type="text" name="country" id="country" required class="form-control">
    </div>

    <div class="form-group">
        <label for="startDate">Date de début :</label>
        <input type="date" name="startDate" id="startDate" required class="form-control">
    </div>

    <div class="form-group">
        <label for="endDate">Date de fin :</label>
        <input type="date" name="endDate" id="endDate" required class="form-control">
    </div>

    <div class="form-group">
        <label for="type">Type :</label>
        <select name="type" id="type" class="form-control">
            <option value="">Type de mission</option>
            <?php foreach ($types as $type) : ?>
                <option value="<?php echo $type->getId(); ?>"><?php echo $type->getTitle(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="status">Status :</label>
        <select name="status" id="status" class="form-control">
            <option value="">Status de la mission</option>
            <?php foreach ($statuses as $status) : ?>
                <option value="<?php echo $status->getId(); ?>"><?php echo $status->getTitle(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="speciality">Spécialité Requise :</label>
        <select name="speciality" id="speciality" class="form-control">
            <option value="">Sélectionnez une spécialité</option>
            <?php foreach ($specialities as $speciality) : ?>
                <option value="<?php echo $speciality->getId(); ?>"><?php echo $speciality->getTitle(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="agents[]">Agent :</label>
        <select name="agents[]" id="agents" class="form-control">
            <option value="">Sélectionnez un agent</option>
            <?php foreach ($agents as $agent) : ?>
                <option value="<?php echo $agent->getId(); ?>"><?php echo $agent->getFirstName().' '.$agent->getLastName(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div id="agentContainer"></div>

    <br>
    <button type="button" class="btn btn-secondary" onclick="ajouterAgent()">Ajout d'un Agent</button>
    <br>
    <br>
    <input type="submit" value="Créer agent" class="btn btn-primary">
</form>

<script src="/kgb/assets/js/AddAgent.js"></script> 
<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>
