<?php
require_once "includes/functions.php";
session_start();

if (isset($_POST['title'])) {
    // the offer form has been posted : retrieve offer parameters
    $title = escape($_POST['title']);
    $offer_type = escape($_POST['offer_type']); 
    $company_name = escape($_POST['company_name']);
    $activity = escape($_POST['activity']);
    $address = escape($_POST['address']);
    $details = escape($_POST['details']);
    $remuneration = escape($_POST['remuneration']);
    $contact_name = escape($_POST['contact_name']);
    $contact_mail = escape($_POST['contact_mail']);

    $tmpFile = $_FILES['file']['tmp_name'];
    if (is_uploaded_file($tmpFile)) {
        // upload job offer pdf
        $file = basename($_FILES['file']['name']);
        $uploadedFile = "pdf/$file";
        move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFile);
    }

    $date_creation=time();
    $code = generateCode();
    
    //insert movie into BD
    $stmt = getDb()->prepare('INSERT INTO `offre`(`type`, `titre`, `entreprise`, `valide`, `secteur`, `lieu`, `remuneration`, `contact`, `fichier`, `offre_code`, `description`, `date_creation`, `nom_contact`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $stmt->execute(array($offer_type, $title, $company_name,0, $activity, $address, $remuneration, $contact_mail, $file, $code, $details, $date_creation, $contact_name));
    
    redirect("index.php");
}

?>

<!doctype html>
<html>

    <?php 
    $pageTitle = "Ajouter une offre";
    require_once "includes/head.php"; 
    ?>

    <body>
        <div class="container pushFooter">
            <?php require_once "includes/header.php"; ?>
            <h2 class="text-center">Ajouter une offre</h2>

            <div class="well">
                <form class="form-horizontal" role="form" enctype="multipart/form-data" action="add_offer.php" method="post">
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Titre</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="title" value="" class="form-control" placeholder="Entrez le titre de l'offre" required autofocus>
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
                                <option value="Stage" selected>Stage</option> 
                                <option value="Emploi" >Emploi</option>
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
                            <input type="text" name="company_name" value="" class="form-control" placeholder="Entrez le nom de l'entreprise" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Secteur d'activité</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="activity" class="form-control" placeholder="Entrez le secteur d'activité" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Adresse de l'entreprise</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="address" value="" class="form-control" placeholder="Entrez l'adresse de l'entreprise" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Détails de l'offre</label>
                        </div>
                        <div class="col-sm-6">
                            <textarea name="details" class="form-control" placeholder="Entrez les détails de l'offre" required></textarea>
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
                            <span class='label label-default' id="upload-file-info"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Rémunération</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" name="remuneration" value="" class="form-control" placeholder="Entrez la rémunération" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Nom du contact</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="contact_name" value="" class="form-control" placeholder="Entrez le nom du contact" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Mail du contact</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="contact_mail" value="" class="form-control" placeholder="Entrez le mail du contact" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-6 text-center ">
                            <button type="submit" class="btn btn-default btn-primary btn-lg"><span class="glyphicon glyphicon-save"></span> Ajouter</button>
                        </div>
                    </div>
                </form> 
            </div>         
        </div>

        <?php require_once "includes/footer.php"; ?>
        <?php require_once "includes/scripts.php"; ?>
    </body>

</html>