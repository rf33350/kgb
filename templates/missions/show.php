<?php require_once _ROOTPATH_.'/templates/header.php'; 
/* @var $cible \App\Entity\Mission */
?>

            <div class="text-center">
                <h1>
                    Mission <?=$mission->getId() ;?>
                </h1>
                <p>Titre : <?=$mission->getTitle() ;?></p>
                <p>Description: <?=$mission->getDescription() ;?></p>
                <p>Nom de code: <?=$mission->getCodeName() ;?></p>
                <p>Pays: <?=$mission->getCountry() ;?></p>
                <p>Date de début: <?=$mission->getStartDate()->format('d-m-Y') ;?></p>
                <p>Date de fin: <?=$mission->getEndDate()->format('d-m-Y') ;?></p>
                <p>Type: <?=$mission->getType_id() ;?></p>
                <p>Status: <?=$mission->getStatus_id() ;?></p>
                <p>Spécialité: <?=$speciality->getTitle() ;?></p>
                <?php foreach ($agents as $agent) { ;?>
                <p>Agent: <?=$agent->getFirstName().' '.$agent->getLastName() ;?></p>
                <?php } ;?>
                <?php foreach ($contacts as $contact) { ;?>
                <p>Contact: <?=$contact->getFirstName().' '.$contact->getLastName() ;?></p>
                <?php } ;?>
                <?php foreach ($hideouts as $hideout) { ;?>
                <p>Planque: <?=$hideout->getAddress().', '.$hideout->getCountry() ;?></p>
                <?php } ;?>
                <?php foreach ($targets as $target) { ;?>
                <p>Cible: <?=$target->getFirstName().' '.$target->getLastName() ;?></p>
                <?php } ;?>
                


                
                <?php 
                if (isset($_SESSION['user'])) {
                    echo '
                    <a href="index.php?controller=mission&action=update&id=<?=$mission->getId() ;?>" class="btn btn-warning">Modifier</a>
                    <br>
                    <br>
                    <a href="index.php?controller=mission&action=delete&id=<?=$mission->getId() ;?>" class="btn btn-danger">Supprimer</a>
                    <br>
                    <br>
                    ';
                }
                ?>
                <a href="index.php?controller=mission&action=list" class="btn btn-primary">Retour à la liste</a>
            </div>



<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>