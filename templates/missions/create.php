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
        <input type="date" name="endDate" id="endDate"  class="form-control">
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
    <div class="form-group">
        <label for="contacts[]">Contact :</label>
        <select name="contacts[]" id="contacts" class="form-control">
            <option value="">Sélectionnez un contact</option>
            <?php foreach ($contacts as $contact) : ?>
                <option value="<?php echo $contact->getId(); ?>"><?php echo $contact->getFirstName().' '.$contact->getLastName(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div id="contactContainer"></div>
    <br>
    <button type="button" class="btn btn-secondary" onclick="ajouterContact()">Ajout d'un contact</button>
    <br>
    <br>
    <div class="form-group">
        <label for="targets[]">Cible :</label>
        <select name="targets[]" id="targets" class="form-control">
            <option value="">Sélectionnez une cible</option>
            <?php foreach ($targets as $target) : ?>
                <option value="<?php echo $target->getId(); ?>"><?php echo $target->getFirstName().' '.$target->getLastName(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div id="targetContainer"></div>
    <br>
    <button type="button" class="btn btn-secondary" onclick="ajouterTarget()">Ajout d'une cible</button>
    <br>
    <br>
    <div class="form-group">
        <label for="hideouts[]">Planques :</label>
        <select name="hideouts[]" id="hideouts" class="form-control">
            <option value="">Sélectionnez une planque</option>
            <?php foreach ($hideouts as $hideout) : ?>
                <option value="<?php echo $hideout->getId(); ?>"><?php echo $hideout->getAddress().', '.$hideout->getCountry(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div id="hideoutContainer"></div>
    <br>
    <button type="button" class="btn btn-secondary" onclick="ajouterHideout()">Ajout d'une planque</button>
    <br>
    <br>
    <input type="submit" value="Créer mission" class="btn btn-primary">
</form>

<script src="/kgb/assets/js/AddAgent.js"></script> 
<script src="/kgb/assets/js/AddContact.js"></script>
<script src="/kgb/assets/js/AddTarget.js"></script>
<script src="/kgb/assets/js/AddHideout.js"></script>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>
