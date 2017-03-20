<?php
require_once "includes/functions.php";
session_start();

if (isset($_POST['surname'])) {
    // the sign up form has been posted : retrieve user infos
    $surname = escape($_POST['surname']);
    $name = escape($_POST['name']); 
    $login = escape($_POST['login']);
    $password = escape($_POST['password']);
    $state = escape($_POST['state']);
    $mail = escape($_POST['mail']);
    
    // insert user into BD
    $stmt = getDb()->prepare('INSERT INTO `personne`(`role`, `adherent`, `login`, `password`, `nom`, `prenom`, `mail`) VALUES (?,?,?,?,?,?,?)');
    $stmt->execute(array($state, 0, $login, $password, $surname, $name, $mail));
    
    $_SESSION['login'] = $login;
    $_SESSION['adherent'] = 0;
    $_SESSION['nom'] = $surname;
    $_SESSION['prenom'] = $name;
        
    redirect("index.php");
}

?>

<!doctype html>
<html>

    <?php 
    $pageTitle = "Inscription";
    require_once "includes/head.php"; 
    ?>

    <body>
        <div class="container pushFooter">
            <?php require_once "includes/header.php"; ?>
            <h2 class="text-center">Inscription</h2>

            <div class="well">
                <form class="form-horizontal" role="form" enctype="multipart/form-data" action="signup.php" method="post">
                    <input type="hidden" name="id" value="">
                    
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Nom</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="surname" value="" class="form-control" placeholder="Entrez votre nom de famille" required autofocus>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Prénom</label>
                        </div>
                        <div class="col-sm-6">
                             <input type="text" name="name" value="" class="form-control" placeholder="Entrez votre prénom" required>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Identifiant</label>
                        </div>
                        <div class="col-sm-6">
                             <input type="text" name="login" value="" class="form-control" placeholder="Entrez votre identifiant" required>
                        </div>
                    </div>                    
                    
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Mot de passe</label>
                        </div>
                        <div class="col-sm-6">
                             <input type="password" name="password" value="" class="form-control" placeholder="Entrez votre mot de passe" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Statut</label>
                        </div>
                        <div class="col-sm-6">
                            <select name="state" class="form-control">
                                <option value="valeur1">Elève</option> 
                                <option value="valeur2" selected>Ancien élève</option>
                                <option value="valeur3">Recruteur</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Mail</label>
                        </div>
                        <div class="col-sm-6">
                             <input type="text" name="mail" value="" class="form-control" placeholder="Entrez votre adresse mail" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-6 text-center">
                            <button type="submit" class="btn btn-default btn-primary btn-lg"><span class="glyphicon glyphicon-save"></span> S'inscrire</button>
                        </div>
                    </div>                    
                    
                </form> 
            </div>
        </div>
        
        <?php require_once "includes/footer.php"; ?>
        <?php require_once "includes/scripts.php"; ?>
    </body>

</html>