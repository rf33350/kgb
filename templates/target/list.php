<?php require_once _ROOTPATH_.'/templates/header.php'; ?>

            <div class="text-center">
                <h1>
                    Nos Cibles
                </h1>
            </div>


            <div class="row text-center">
            <?php foreach ($cibles as $cible) { ?>
                <div class="col-md-4 my-2 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo  $cible->getFirstName().' '.$cible->getLastName(); ?></h5>
                            <p class="card-text"><?php echo  $cible->getBirthDate()->format('d/m/Y'); ?></p>
                            <p class="card-text"><?php echo  $cible->getCode(); ?></p>
                            <p class="card-text"><?php echo  $cible->getNationality(); ?></p>
                            <a href="index.php?controller=target&action=show&id=<?=  $cible->getId(); ?>" class="btn btn-primary">Détails</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
            <br>
            <div class="text-center">
            <a href="index.php?controller=target&action=create" class="btn btn-secondary">Créer une nouvelle cible</a>
            </div>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>