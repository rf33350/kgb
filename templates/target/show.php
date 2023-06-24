<?php require_once _ROOTPATH_.'/templates/header.php'; 
/* @var $cible \App\Entity\Target */
?>

            <div class="text-center">
                <h1>
                    Cible <?=$cible->getId() ;?>
                </h1>
                <p>Prénom: <?=$cible->getFirstName() ;?></p>
                <p>Nom: <?=$cible->getLastName() ;?></p>
                <p>Date de Naissance: <?=$cible->getBirthDate()->format('d-m-Y') ;?></p>
                <p>Code: <?=$cible->getCode() ;?></p>
                <p>Nationalité: <?=$cible->getNationality() ;?></p>

                <a href="index.php?controller=target&action=update&id=<?=$cible->getId() ;?>" class="btn btn-warning">Modifier</a>
                <br>
                <br>
                <a href="index.php?controller=target&action=delete&id=<?=$cible->getId() ;?>" class="btn btn-danger">Supprimer</a>
                <br>
                <br>
                <a href="index.php?controller=target&action=list" class="btn btn-primary">Retour à la liste</a>
            </div>



<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>