<?php
require_once "includes/functions.php";
session_start();

$exist = false;
if (isset($_POST['update'])) {
    $result = getDb()->query("SELECT * FROM `offre` WHERE `offre_code` = '".$_POST["offre_code"]."'");
    if($result->rowCount() >=1) {
        $exist = true;              
        $offer = $result->fetch();
    }
}

if(isset($_POST['title'])) {
    // the offer form has been posted : retrieve offer parameters
    $id = escape($_POST['id']);
    $title = escape($_POST['title']);
    $offer_type = escape($_POST['offer_type']); 
    $company_name = escape($_POST['company_name']);
    $activity = escape($_POST['activity']);
    $address = escape($_POST['address']);
    $details = escape($_POST['details']);
    $remuneration = escape($_POST['remuneration']);
    $contact_name = escape($_POST['contact_name']);
    $contact_mail = escape($_POST['contact_mail']);
    $file = $_POST['file_name'];

    $tmpFile = $_FILES['file']['tmp_name'];
    if (is_uploaded_file($tmpFile)) {
        // upload job offer pdf
        $file = basename($_FILES['file']['name']);
        $uploadedFile = "pdf/$file";
        move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFile);
    }
    
    // Update offer
    $stmt = getDb()->prepare('UPDATE `offre` SET `type`= ? ,`titre`= ?, `entreprise`= ?, `valide`= ?, `secteur`= ?, `lieu`= ?, `remuneration`= ?, `contact`= ?,`fichier`= ?,`description`= ?,`nom_contact`= ? WHERE `offre_id` = ?');
    $stmt->execute(array($offer_type, $title, $company_name,0, $activity, $address, $remuneration, $contact_mail, $file, $details, $contact_name,$id));
   
}
?>

<!doctype html>
<html>

    <?php 
    $pageTitle = "Modifier une offre";
    require_once "includes/head.php"; 
    ?>

    <body onload="dyntextarea();">
        <div class="container pushFooter">
            <?php require_once "includes/header.php";
            
                if (isset($_GET['offre_id']) && isUserAdmin()){
                    $result = getDb()->query("SELECT * FROM `offre` WHERE `offre_id` = ".$_GET["offre_id"]."");
                    if($result->rowCount() >=1) {
                    $exist = true;              
                    $offer = $result->fetch();
                    }
                }
            ?>
            
            <h2 class="text-center">Modifier une offre</h2>

            <div class="well">
                <form class="form-horizontal" role="form" enctype="multipart/form-data" action="update_offer.php" method="post">

                    <?php if (!isset($_POST['modif']) && !$exist) {

                    ?>
                    <input type="hidden" name="update" value="1">
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
                    <input type="hidden" name="id" value="<?= $offer['offre_id'] ?>">
                    <input type="hidden" name="file_name" value="<?= $offer['fichier'] ?>">
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
                            <label class="visible-xs control-label">Détails de l'offre</label>
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Détails de l'offre</label>
                        </div>
                        <div class="col-sm-6">
                            <textarea name="details" class="form-control expanding" placeholder="Entrez les détails de l'offre" required><?= $offer['description'] ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Fiche de poste</label>
                        </div>
                        <div class="col-sm-6">
                            <label class="btn btn-default" for="my-file-selector">
                                <input id="my-file-selector" type="file" name="file" style="display:none;" onchange="$('#upload-file-info').html($(this).val());" accept="application/pdf">
                                <span class="icon-span-filestyle glyphicon glyphicon-folder-open"></span> Choisir un fichier PDF
                            </label>
                            <span class='label label-default' id="upload-file-info"><?= $offer['fichier'] ?></span>
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