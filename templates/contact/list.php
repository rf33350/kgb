<?php require_once _ROOTPATH_.'/templates/header.php'; ?>

            <div class="text-center">
                <h1>
                    Nos Contacts
                </h1>
            </div>


            <div class="row text-center">
            <?php foreach ($contacts as $contact) { ?>
                <div class="col-md-4 my-2 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo  $contact->getFirstName().' '.$contact->getLastName(); ?></h5>
                            <p class="card-text"><?php echo  $contact->getBirthDate()->format('d/m/Y'); ?></p>
                            <p class="card-text"><?php echo  $contact->getCode(); ?></p>
                            <p class="card-text"><?php echo  $contact->getNationality(); ?></p>
                            <a href="index.php?controller=contact&action=show&id=<?=  $contact->getId(); ?>" class="btn btn-primary">Détails</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
            <br>
            <div class="text-center">
            <a href="index.php?controller=contact&action=create" class="btn btn-secondary">Créer un nouveau contact</a>
            </div>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>