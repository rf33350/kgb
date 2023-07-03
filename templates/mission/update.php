<?php 
    require_once _ROOTPATH_.'/templates/header.php'; 
    require_once _ROOTPATH_.'/templates/redirect.php'; 
?>

<div class="text-center">
    <h1>Modification de la mission "<?php echo $mission->getTitle(); ?>"</h1>
</div>

<form action="index.php?controller=mission&action=update&id=<?php echo $mission->getId(); ?>" method="POST" class="form">
    <input type="hidden" name="updateMission">

    <div class="form-group">
        <label for="title">Titre :</label>
        <input type="text" name="title" id="title" value="<?php echo $mission->getTitle(); ?>" required class="form-control">
    </div>

    <div class="form-group">
        <label for="description">Description :</label>
        <input type="text" name="description" id="description" value="<?php echo $mission->getDescription(); ?>" required class="form-control">
    </div>

    <div class="form-group">
        <label for="codeName">Nom de code :</label>
        <input type="text" name="codeName" id="codeName" value="<?php echo $mission->getCodeName(); ?>" required class="form-control">
    </div>

    <div class="form-group">
        <label for="country">Pays :</label>
        <input type="text" name="country" id="country" value="<?php echo $mission->getCountry(); ?>" required class="form-control">
    </div>

    <div class="form-group">
        <label for="startDate">Date de début :</label>
        <input type="date" name="startDate" id="startDate" value="<?php echo $mission->getStartDate()->format('Y-m-d'); ?>" required class="form-control">
    </div>

    <div class="form-group">
        <label for="endDate">Date de fin :</label>
        <input type="date" name="endDate" id="endDate" <?php if ($mission->getEndDate()) { ?> value="<?php echo $mission->getEndDate()->format('Y-m-d'); ?>"  <?php } ?> class="form-control">
    </div>
    
    <div class="form-group">
        <label for="type">Type :</label>
        <select name="type" id="type" class="form-control">
            <option value=""><?php if ($missiontype) { echo $missiontype; } else { echo 'Type de la mission';} ?></option>
            <?php foreach ($types as $type) : ?>
                <option value="<?php echo $type->getId(); ?>"><?php echo $type->getTitle(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="status">Status :</label>
        <select name="status" id="status" class="form-control">
            <option value=""><?php if ($missionstatus) { echo $missionstatus; } else { echo 'Status de la mission';} ?></option>
            <?php foreach ($statuses as $status) : ?>
                <option value="<?php echo $status->getId(); ?>"><?php echo $status->getTitle(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="speciality">Spécialité Requise :</label>
        <select name="speciality" id="speciality" class="form-control">
            <option value=""><?php if ($missionspeciality) { echo $missionspeciality; } else { echo 'Sélectionnez une spécialité';} ?></option>
            <?php foreach ($specialities as $speciality) : ?>
                <option value="<?php echo $speciality->getId(); ?>"><?php echo $speciality->getTitle(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <?php foreach ($agentsInMission as $agentInMission) : ?>
        <div class="form-group">
            <label for="agents[]">Agent :</label>
            <select name="agents[]" id="agents" class="form-control">
                <option value=""><?php echo $agentInMission->getFirstName().' '.$agentInMission->getLastName(); ?></option>
                <?php foreach ($agents as $agent) : ?>
                    <option value="<?php echo $agent->getId(); ?>"><?php echo $agent->getFirstName().' '.$agent->getLastName(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endforeach; ?>

    <div id="agentContainer"></div>
    <br>
    <button type="button" class="btn btn-secondary" onclick="ajouterAgent()">Ajout d'un Agent</button>
    <br>
    <br>
    <?php foreach ($contactsInMission as $contactInMission) : ?>
        <div class="form-group">
            <label for="contacts[]">Contact :</label>
            <select name="contacts[]" id="contacts" class="form-control">
                <option value=""><?php echo $contactInMission->getFirstName().' '.$contactInMission->getLastName(); ?></option>
                <?php foreach ($contacts as $contact) : ?>
                    <option value="<?php echo $contact->getId(); ?>"><?php echo $contact->getFirstName().' '.$contact->getLastName(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endforeach; ?>
    <div id="contactContainer"></div>
    <br>
    <button type="button" class="btn btn-secondary" onclick="ajouterContact()">Ajout d'un contact</button>
    <br>
    <br>
    <?php foreach ($targetsInMission as $targetInMission) : ?>
        <div class="form-group">
            <label for="targets[]">Cible :</label>
            <select name="targets[]" id="targets" class="form-control">
            <option value=""><?php echo $targetInMission->getFirstName().' '.$targetInMission->getLastName(); ?></option>
                <?php foreach ($targets as $target) : ?>
                    <option value="<?php echo $target->getId(); ?>"><?php echo $target->getFirstName().' '.$target->getLastName(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endforeach; ?>
    <div id="targetContainer"></div>
    <br>
    <button type="button" class="btn btn-secondary" onclick="ajouterTarget()">Ajout d'une cible</button>
    <br>
    <br>
    <?php foreach ($hideoutsInMission as $hideoutInMission) : ?>
        <div class="form-group">
            <label for="hideouts[]">Planques :</label>
            <select name="hideouts[]" id="hideouts" class="form-control">
            <option value=""><?php echo $hideoutInMission->getAddress().', '.$hideoutInMission->getCountry(); ?></option>
                <?php foreach ($hideouts as $hideout) : ?>
                    <option value="<?php echo $hideout->getId(); ?>"><?php echo $hideout->getAddress().', '.$hideout->getCountry(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endforeach; ?>
    
    <div id="hideoutContainer"></div>
    <br>
    <button type="button" class="btn btn-secondary" onclick="ajouterHideout()">Ajout d'une planque</button>
    <br>
    <br>
    <input type="submit" value="Modifier mission" class="btn btn-primary">
</form>

<script src="/kgb/assets/js/AddAgent.js"></script> 
<script src="/kgb/assets/js/AddContact.js"></script>
<script src="/kgb/assets/js/AddTarget.js"></script>
<script src="/kgb/assets/js/AddHideout.js"></script>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>
