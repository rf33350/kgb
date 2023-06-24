<?php require_once _ROOTPATH_.'/templates/header.php'; 
/* @var $cible \App\Entity\Target */
?>

            <div class="text-center">
                <h1>
                    Agent <?=$agent->getId() ;?>
                </h1>
                <p>Prénom: <?=$agent->getFirstName() ;?></p>
                <p>Nom: <?=$agent->getLastName() ;?></p>
                <p>Date de Naissance: <?=$agent->getBirthDate()->format('d-m-Y') ;?></p>
                <p>Code: <?=$agent->getCode() ;?></p>
                <p>Nationalité: <?=$agent->getNationality() ;?></p>
                <?php 
                    foreach ($agent->getSpecialities() as $speciality) { ?>
                    <p class="card-text"><?php echo  $speciality->getTitle(); ?></p>
                <?php } ?>

                <a href="index.php?controller=agent&action=update&id=<?=$agent->getId() ;?>" class="btn btn-warning">Modifier</a>
                <br>
                <br>
                <a href="index.php?controller=agent&action=delete&id=<?=$agent->getId() ;?>" class="btn btn-danger">Supprimer</a>
                <br>
                <br>
                <a href="index.php?controller=agent&action=list" class="btn btn-primary">Retour à la liste</a>
            </div>



<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>