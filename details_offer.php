<?php
require_once "includes/functions.php";
session_start();

// Retrieve offer
if(isUserConnected()){
    $offer_id = $_GET['id'];
    $stmt = getDb()->prepare('SELECT * FROM `offre` WHERE `offre_id` = ? ');
    $stmt->execute(array($offer_id));
    $offer = $stmt->fetch(); // Access first (and only) result line
}

?>

<!doctype html>
<html>

    <?php 
    $pageTitle = "une offre";
    require_once "includes/head.php"; 
    ?>

    <body>
        <div class="container pushFooter">
            <?php require_once "includes/header.php"; ?>
            <h2 class="text-center">Détails de l'offre</h2>

            <div class="well">
                <form class="form-horizontal" role="form" enctype="multipart/form-data" action="postulate.php" method="post">
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
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Détails de l'offre</label>
                        </div>
                        <div class="col-sm-6">
                            <div class="expandingArea">
                                <textarea name="details" disabled="disabled" class="form-control" required autofocus><?= $offer['description'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Fiche de poste</label>
                        </div>
                        <div class="col-sm-6">
                            <label for="files" class="btn btn-default"><span class="icon-span-filestyle glyphicon glyphicon-folder-open"></span> Choisir un fichier PDF</label>
                            <input id="files" type="file" name="file" class="filestyle pull-right"  style="visibility:hidden;" accept="application/pdf"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Rémunération</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="remuneration" value="<?= $offer['remuneration'] ?>" disabled="disabled" class="form-control" required autofocus>
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
                        <div class="col-sm-6 text-center ">
                            <button type="submit" class="btn btn-default btn-primary btn-lg"><span class="glyphicon glyphicon-save"></span>Postuler</button>
                        </div>
                    </div>
                </form> 
            </div>         
        </div>
        
        <?php require_once "includes/footer.php"; ?>
        <?php require_once "includes/scripts.php"; ?>
    </body>

</html>