<?php
require_once "includes/functions.php";
session_start();

?>

<!doctype html>
<html>

    <?php 
    $pageTitle = "Inscription";
    require_once "includes/head.php"; 
    ?>

    <body>
        <div class="container">
            <?php require_once "includes/header.php"; ?>
            <h2 class="text-center">Inscription</h2>

            <div class="well">
                <form class="form-horizontal" role="form" enctype="multipart/form-data" action="signup.php" method="post">
                    <input type="hidden" name="id" value="">
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nom</label>
                        <div class="col-sm-6">
                            <input type="text" name="surname" value="" class="form-control" placeholder="Entrez votre nom de famille" required autofocus>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Prénom</label>
                        <div class="col-sm-6">
                             <input type="text" name="name" value="" class="form-control" placeholder="Entrez votre prénom" required>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Identifiant</label>
                        <div class="col-sm-6">
                             <input type="text" name="login" value="" class="form-control" placeholder="Entrez votre identifiant" required>
                        </div>
                    </div>                    
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Mot de passe</label>
                        <div class="col-sm-6">
                             <input type="text" name="password" value="" class="form-control" placeholder="Entrez votre mot de passe" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Statut</label>
                        <div class="col-sm-6">
                            <select name="select">
                                <option value="valeur1">Elève</option> 
                                <option value="valeur2" selected>Ancien élève</option>
                                <option value="valeur3">Recruteur</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Mail</label>
                        <div class="col-sm-6">
                             <input type="text" name="mail" value="" class="form-control" placeholder="Entrez votre adresse mail" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-4">
                            <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-save"></span>Inscription</button>
                        </div>
                    </div>                    
                    
                </form> 
            </div>

            <?php require_once "includes/footer.php"; ?>
        </div>

        <?php require_once "includes/scripts.php"; ?>
    </body>

</html>