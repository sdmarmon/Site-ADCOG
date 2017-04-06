<?php
require_once "includes/functions.php";
session_start();

// Retrieve offer
if(isUserConnected()){
    $offer_id = $_GET['id'];
    $stmt = getDb()->prepare('SELECT * FROM `offre` WHERE `offre_id` = ? ');
    $stmt->execute(array($offer_id));
    $offer = $stmt->fetch(); // Access first (and only) result line

    if(isset($_GET['action'])){
        if($_GET['action']=="apply"){
            $stmt = getDb()->prepare('SELECT * FROM `postuler` WHERE `offre_id`= ? AND `personne_id` = ?');
            $stmt->execute(array($offer_id,$_SESSION['id']));

            if($stmt->rowCount() ==0){
                $stmt = getDb()->prepare("INSERT INTO `postuler`(`offre_id`, `personne_id`) VALUES (?,?)");
                $stmt->execute(array($offer_id,$_SESSION['id']));
            }
        }

        if($_GET['action']=="favorite"){
            $stmt = getDb()->prepare('SELECT * FROM `sauvegarder` WHERE `offre_id`= ? AND `personne_id` = ?');
            $stmt->execute(array($offer_id,$_SESSION['id']));
            
            if($stmt->rowCount() ==0){
                $stmt = getDb()->prepare("INSERT INTO `sauvegarder`(`offre_id`, `personne_id`) VALUES (?,?)");
                $stmt->execute(array($offer_id,$_SESSION['id']));
            }
        }

        //redirect("index.php");
    }
}

?>

<!doctype html>
<html>

    <?php 
    $pageTitle = "Détails offre";
    require_once "includes/head.php"; 
    ?>

    <body>
        <div class="container pushFooter">
            <?php require_once "includes/header.php"; ?>
            <h2 class="text-center">Détails de l'offre</h2>

            <div class="well">
                <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Titre</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="title" value="<?= $offer['titre'] ?>" disabled="disabled" class="form-control" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label ">Type d'offre</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="offer_type" value="<?= $offer['type'] ?>" disabled="disabled" class="form-control" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Nom de l'entreprise</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="company_name" value="<?= $offer['entreprise'] ?>" disabled="disabled" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Secteur d'activité</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="activity" value="<?= $offer['secteur'] ?>" disabled="disabled" class="form-control" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Adresse de l'entreprise</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="adress" value="<?= $offer['lieu'] ?>" disabled="disabled" class="form-control" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="visible-xs control-label">Détails de l'offre</label>
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Détails de l'offre</label>
                        </div>
                        <div class="col-sm-6">
                            <textarea name="details" disabled="disabled" class="form-control expanding" required autofocus><?= $offer['description'] ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Fiche de poste</label>
                        </div>
                        <div class="col-sm-6">
                            <a href="/pdf/<?= $offer['fichier'] ?>" class="btn btn-default" download="Fiche_poste"><span class="icon-span-filestyle glyphicon glyphicon-file"></span> Télécharger la fiche de poste en PDF</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Rémunération</label>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">

                                <input type="number" name="remuneration" value="<?= $offer['remuneration'] ?>" class="form-control" placeholder="Entrez la rémunération" disabled="disabled" required>
                                <span class="input-group-addon">€</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Nom du contact</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="contact_name" value="<?= $offer['nom_contact'] ?>" disabled="disabled" class="form-control" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Mail du contact</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="contact_mail" value="<?= $offer['contact'] ?>" disabled="disabled" class="form-control" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-6 text-center">
                            <a href="details_offer.php?id=<?= $offer['offre_id'] ?>&action=apply" class="btn btn-default btn-primary btn-lg">Postuler</a>
                            <a href="details_offer.php?id=<?= $offer['offre_id'] ?>&action=favorite" class="btn btn-default btn-primary btn-lg"><span class="glyphicon glyphicon-star"></span> Ajouter aux offres favorites</a>
                        </div>
                    </div>
                </form>
            </div>         
        </div>

        <?php require_once "includes/footer.php"; ?>
        <?php require_once "includes/scripts.php"; ?>
    </body>

</html>