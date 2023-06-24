<?php require_once _ROOTPATH_.'/templates/header.php'; 
/* @var $cible \App\Entity\Target */
?>

            <div class="text-center">
                <h1>
                    Contact <?=$contact->getId() ;?>
                </h1>
                <p>Prénom: <?=$contact->getFirstName() ;?></p>
                <p>Nom: <?=$contact->getLastName() ;?></p>
                <p>Date de Naissance: <?=$contact->getBirthDate()->format('d-m-Y') ;?></p>
                <p>Code: <?=$contact->getCode() ;?></p>
                <p>Nationalité: <?=$contact->getNationality() ;?></p>

                <a href="index.php?controller=contact&action=update&id=<?=$contact->getId() ;?>" class="btn btn-warning">Modifier</a>
                <br>
                <br>
                <a href="index.php?controller=contact&action=delete&id=<?=$contact->getId() ;?>" class="btn btn-danger">Supprimer</a>
                <br>
                <br>
                <a href="index.php?controller=contact&action=list" class="btn btn-primary">Retour à la liste</a>
            </div>



<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>