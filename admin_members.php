<?php
require_once "includes/functions.php";
session_start();

// Retrieve offers
if(isUserAdmin()){
    if(isset($_GET["action"])){
        if($_GET["action"]=='remove'){
            //remove user
            $stmt = getDb()->prepare('DELETE FROM `personne` WHERE `personne_id`= ?');
            $stmt->execute(array($_GET["personne_id"]));
        }
        elseif($_GET["action"]=='confirm_update'){
            //update user
            //$stmt = getDb()->prepare('');
            //$stmt->execute(array());
        }
    }    
    $users = getDb()->query('SELECT * FROM `personne`');
}

?>

<!doctype html>
<html>

    <?php 
    $pageTitle = "Membres (Admin)";
    require_once "includes/head.php";
    require_once "includes/confirm.php";
    ?>

    <body>
        <div class="container pushFooter">
            <?php require_once "includes/header.php"; ?>
            <?php if(isUserAdmin()){
    if (isset($_GET["action"])){
        if ($_GET["action"]=='update'){
            $result = getDb()->query("SELECT * FROM `personne` WHERE `personne_id`= ".$_GET["personne_id"]."");
            if($result->rowCount() >=1) {            
                $user = $result->fetch();?>

            <h2 class="text-center">Modifier une offre</h2>

            <div class="well">
                <form class="form-horizontal" role="form" enctype="multipart/form-data" action="admin_members.php" method="post">

                    <input type="hidden" name="id" value="<?= $user['personne_id'] ?>">
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Role</label>
                        </div>
                        <div class="col-sm-6">
                            <select name="offer_type" class="form-control">     
                                <option value="administrateur"  <?php if ($user['role'] == "adminstrateur") { echo "selected" ;} ?> >Administrateur</option>
                                <option value="ancien élève"  <?php if ($user['role'] == "ancien eleve") { echo "selected" ;} ?> >Ancien Elève</option>
                                <option value="élève"  <?php if ($user['role'] == "élève") { echo "selected" ;} ?> >Elève</option>
                                <option value="recruteur"  <?php if ($user['role'] == "recruteur") { echo "selected" ;} ?> >Recruteur</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label ">Adhérent</label>
                        </div>
                        <div class="col-sm-6">
                            <div class="radio">
                                <label><input type="radio" name="optradio" value=1>Oui</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="optradio" value=2>Non</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Login</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="login" value="<?= $user['login'] ?>" class="form-control" placeholder="Entrez le login de l'utilisateur" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-6 text-center ">
                            <button type="submit" class="btn btn-default btn-primary btn-lg"><span class="glyphicon glyphicon-save"></span>Modifier</button>
                        </div>
                    </div>
                </form>
            </div>
            <?php}
            else {?>
            <div class="alert alert-danger">
                <p><strong> Attention !</strong> Ce membre n'existe pas.</p>
            </div>
            <div>
                <center><a href="amdin_members.php">Retour au panneau d'aministration des membres.</a></center>
            </div>                    
            <?php }
        }  
    }

    else{ ?>
            <div>
                <div>
                    <form class="navbar-form" role="search" method="post">
                        <div class="col-sm-3">
                        </div>
                        <div class="input-group col-sm-6">
                            <input type="text" class="form-control" placeholder="Rechercher un membre" name="search">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered  text-center">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Nom</th>
                                <th class="text-center">Prénom</th>
                                <th class="text-center">Mail</th>
                                <th class="text-center">Login</th>
                                <th class="text-center">Adhérent</th>
                                <th class="text-center col-md-1">Modifier</th>
                                <th class="text-center col-md-1" >Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) { ?>
                            <tr>
                                <a href="details_offer.php?id=<?= $user['personne_id'] ?>">
                                    <th class="text-center" scope="row"><?= $user['personne_id'] ?></th>
                                    <td><?= $user['role'] ?></td>
                                    <td><?= $user['nom'] ?></td>
                                    <td><?= $user['prenom'] ?></td>
                                    <td><?= $user['mail'] ?></td>
                                    <td><?= $user['login'] ?></td>
                                    <?php if($user['adherent']==1) { ?>
                                    <td>OUI</td>
                                    <?php }else{ ?>
                                    <td>NON</td>
                                    <?php } ?>
                                </a>
                                <td>
                                    <a href="#" data-href="admin_members.php?personne_id=<?= $user['personne_id'] ?>&action=update" class="btn btn-xs btn-warning btn-block" data-toggle="modal" data-target="#confirm-alert"><i class="glyphicon glyphicon-pencil"></i></a>
                                </td>
                                <td>
                                    <a href="#" data-href="admin_members.php?personne_id=<?= $user['personne_id'] ?>&action=remove" class="btn btn-xs btn-danger btn-block" data-toggle="modal" data-target="#confirm-alert"><i class="glyphicon glyphicon-remove"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php }}else{ ?>
            <div class="alert alert-danger">
                <p><strong> Attention !</strong> Vous n'avez pas accès aux outils d'administration.</p>
            </div>
            <div>
                <center><a href="index.php">Revenir à l'accueil.</a></center>
            </div>
            <?php } ?>
        </div>

        <?php require_once "includes/footer.php";?>

        <?php require_once "includes/scripts.php"; ?>
        
    </body>

</html>