<?php
require_once "includes/functions.php";
session_start();

$exist = false;
if (isset($_POST['modif'])) {
    $result = getDb()->query("SELECT * FROM `offre` WHERE `offre_code` = '".$_POST["offre_code"]."' ");
    if($result->rowCount() >=1) {
        $exist = true;              
        $offer = $result->fetch();
    }

}

?>

<!doctype html>
<html>

    <?php 
    $pageTitle = "Modifier une offre";
    require_once "includes/head.php"; 
    ?>

    <body>
        <div class="container pushFooter">
            <?php require_once "includes/header.php"; ?>
            <h2 class="text-center">Modifier une offre</h2>

            <div class="well">
                <form class="form-horizontal" role="form" enctype="multipart/form-data" action="update_offer.php" method="post">

                    <?php if (!isset($_POST['modif']) && !$exist) {

                    ?>
                    <input type="hidden" name="modif" value="1">
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                            <input type="text" name="offre_code" class="form-control" placeholder="Entrez le code de l'offre" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                            <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-ok-circle"></span> Valider</button>
                        </div>
                    </div>

                    <?php }else{ ?>

                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Titre</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="title" value="<?= $offer['titre'] ?>" class="form-control" placeholder="Entrez le titre de l'offre" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label ">Type d'offre</label>
                        </div>
                        <div class="col-sm-6">
                            <select name="offer_type" class="form-control">     
                                <option value="Stage"  <?php if ($offer['type'] == "Stage") { echo "selected" ;} ?> >Stage</option> 
                                <option value="Emploi"  <?php if ($offer['type'] == "Emploi") { echo "selected" ;} ?> >Emploi</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Nom de l'entreprise</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="company_name" value="<?= $offer['entreprise'] ?>" class="form-control" placeholder="Entrez le nom de l'entreprise" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Secteur d'activité</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="activity" value="<?= $offer['secteur'] ?>" class="form-control" placeholder="Entrez le secteur d'activité" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Adresse de l'entreprise</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="address" value="<?= $offer['lieu'] ?>" class="form-control" placeholder="Entrez l'adresse de l'entreprise" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Détails de l'offre</label>
                        </div>
                        <div class="col-sm-6">
                            <textarea name="details" class="form-control" placeholder="Entrez les détails de l'offre" required><?= $offer['description'] ?></textarea>
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
                            <p><?= $offer['fichier'] ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Rémunération</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" name="remuneration" value="<?= $offer['remuneration'] ?>" class="form-control" placeholder="Entrez la rémunération" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Nom du contact</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="contact_name" value="<?= $offer['nom_contact'] ?>" class="form-control" placeholder="Entrez le nom du contact" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Mail du contact</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="contact_mail" value="<?= $offer['contact'] ?>" class="form-control" placeholder="Entrez le mail du contact" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-6 text-center ">
                            <button type="submit" class="btn btn-default btn-primary btn-lg"><span class="glyphicon glyphicon-save"></span>Modifier</button>
                        </div>
                    </div>
                    <?php } ?>
                </form> 
            </div>         
        </div>

        <?php require_once "includes/footer.php"; ?>
        <?php require_once "includes/scripts.php"; ?>
    </body>

</html>