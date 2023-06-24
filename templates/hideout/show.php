<?php require_once _ROOTPATH_.'/templates/header.php'; 
/* @var $cible \App\Entity\Target */
?>

            <div class="text-center">
                <h1>
                    Planque <?=$planque->getId() ;?>
                </h1>
                <p>Adresse: <?=$planque->getAddress() ;?></p>
                <p>Pays: <?=$planque->getCountry() ;?></p>
                <p>Code: <?=$planque->getCode() ;?></p>

                <a href="index.php?controller=hideout&action=update&id=<?=$planque->getId() ;?>" class="btn btn-warning">Modifier</a>
                <br>
                <br>
                <a href="index.php?controller=hideout&action=delete&id=<?=$planque->getId() ;?>" class="btn btn-danger">Supprimer</a>
                <br>
                <br>
                <a href="index.php?controller=hideout&action=list" class="btn btn-primary">Retour à la liste</a>
            </div>



<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>