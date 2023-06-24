<?php require_once _ROOTPATH_.'/templates/header.php'; ?>

            <div class="text-center">
                <h1>
                    Nos Planques
                </h1>
            </div>


            <div class="row text-center">
            <?php foreach ($planques as $planque) { ?>
                <div class="col-md-4  my-2 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo  $planque->getAddress(); ?></h5>
                            <p class="card-text"><?php echo  $planque->getCountry(); ?></p>
                            <p class="card-text"><?php echo  $planque->getCode(); ?></p>
                            <a href="index.php?controller=hideout&action=show&id=<?=  $planque->getId(); ?>" class="btn btn-primary">Détails</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
            <br>
            <div class="text-center">
            <a href="index.php?controller=hideout&action=create" class="btn btn-secondary">Créer une nouvelle planque</a>
            </div>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>