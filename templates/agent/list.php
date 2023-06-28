<?php require_once _ROOTPATH_.'/templates/header.php'; ?>

    <div class="text-center">
        <h1>
            Nos Agents
        </h1>
    </div>
    <div class="row text-center">
    <?php foreach ($agents as $agent) { ?>
        <div class="col-md-4 my-2 d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo  $agent->getFirstName().' '.$agent->getLastName(); ?></h5>
                    <p class="card-text"><?php echo  $agent->getBirthDate()->format('d/m/Y'); ?></p>
                    <p class="card-text"><?php echo  $agent->getCode(); ?></p>
                    <p class="card-text"><?php echo  $agent->getNationality(); ?></p>
                    <?php 
                    foreach ($agent->getSpecialities() as $speciality) { ?>
                    <p class="card-text"><?php echo  $speciality->getTitle(); ?></p>
                    <?php } ?>
                
                    <a href="index.php?controller=agent&action=show&id=<?=  $agent->getId(); ?>" class="btn btn-primary">Détails</a>
                </div>
            </div>
        </div>
    <?php } ?>
    </div>
    <br>
    <div class="text-center">
    <a href="index.php?controller=agent&action=create" class="btn btn-secondary">Créer un nouvel agent</a>
    </div>
    

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>