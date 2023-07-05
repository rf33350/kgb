<?php require_once _ROOTPATH_.'/templates/header.php'; ?>

            <div class="text-center">
                <h1>
                    Les missions répertoriées
                </h1>
            </div>


            <div class="row text-center">
            <?php foreach ($missions as $mission) { ?>
                <div class="col-md-4 my-2 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo  $mission->getTitle(); ?></h5>
                            <p class="card-text"><?php echo  $mission->getDescription(); ?></p>
                            <p class="card-text"><?php echo  $mission->getCodeName(); ?></p>
                            <p class="card-text"><?php echo  $mission->getCountry(); ?></p>
                            <a href="index.php?controller=mission&action=show&id=<?=  $mission->getId(); ?>" class="btn btn-primary">Détails</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
            <br>
            <?php 
                if (isset($_SESSION['user'])) {
                    echo '
                    <div class="text-center">
                    <a href="index.php?controller=mission&action=create" class="btn btn-secondary">Créer une nouvelle mission</a>
                    </div>
                    ';
                }
            ?>
            

                
<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>