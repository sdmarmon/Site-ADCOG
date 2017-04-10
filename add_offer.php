<?php
require_once "includes/functions.php";
session_start();

$code = generateCode();
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
    else{
        $file = null;
    }

    $date_creation=time();

    //insert offer into BD
    $stmt = getDb()->prepare('INSERT INTO `offre`(`type`, `titre`, `entreprise`, `valide`, `secteur`, `lieu`, `remuneration`, `contact`, `fichier`, `offre_code`, `description`, `date_creation`, `nom_contact`,`date_validation`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $stmt->execute(array($offer_type, $title, $company_name,0, $activity, $address, $remuneration, $contact_mail, $file, $code, $details, $date_creation, $contact_name,0));
    
    if (isUserConnected()){
        $req = "SELECT `offre_id` FROM `offre` WHERE `titre` = '".$title."' AND `date_creation` = '".$date_creation."'";
        $stmt = getDb()->query($req);
        $offer = $stmt->fetch();
        $req = "SELECT `personne_id` FROM `personne` WHERE `login` = '".$_SESSION['login']."' ";
        $stmt = getDb()->query($req);
        $user_id = $stmt->fetch();
        $stmt = getDb()->prepare('INSERT INTO `creer`(`offre_id`, `personne_id`) VALUES (?,?)');
        $stmt->execute(array($offer['offre_id'], $user_id['personne_id']));
    }
    
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
            <?php if(isset($_POST['title'])){ ?>
            <h2 class="text-center"><span class="glyphicon glyphicon-info-sign"></span></h2>
            <div class="well">
                <h4 class="text-center">Sauvegardez précieusement ce code qui vous permettra de modifier votre offre ultérieurement.</h4>
                <?php if(isUserConnected()){ ?>
                <h5 class="text-center">Vous pouvez également modifier l'offre depuis vos offres crées.</h5>
                <?php } ?>
                <h3 class="text-center" style="color:red"><?= $code ?></h3>
                <br>
                <center><a href="index.php" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Revenir à l'accueil</a></center>                   
            </div>                    
            <?php }else{ ?>
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
                            <textarea name="details" class="form-control expanding" placeholder="Entrez les détails de l'offre" required></textarea>
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
                            <label class="control-label">Salaire (Brut/mois)</label>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="number" name="remuneration" value="" class="form-control" placeholder="Entrez la rémunération" required>
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
                            <input type="mail" name="contact_mail" value="" class="form-control" placeholder="Entrez le mail du contact" required>
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
            <?php } ?>
        </div>

        <?php require_once "includes/footer.php"; ?>
        <?php require_once "includes/scripts.php"; ?>
    </body>

</html>