<?php
require_once "includes/functions.php";
session_start();

// Retrieve offers
if(isUserAdmin()){
    $users = getDb()->query('SELECT * FROM `personne`');
}

?>

<!doctype html>
<html>

    <?php require_once "includes/head.php"; ?>

    <body>
        <div class="container pushFooter">
            <?php require_once "includes/header.php"; ?>
            <?php if(isUserAdmin()){ ?>
            <div>
                <div>
                    <form class="navbar-form" role="search" method="post">
                        <div class="col-sm-3">
                        </div>
                        <div class="input-group col-sm-6">
                            <input type="text" class="form-control" placeholder="Rechercher une offre" name="search">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <ul class="list-group">
                    <?php foreach ($users as $user) { ?>
                    <li class="list-group-item list-group-item-action">
                        <a href="offer.php?id=<?= $user['personne_id'] ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                            <strong class="text-muted pull-right"><?= $user['role'] ?></strong>
                            <h4 class="mb-1 text-primary"><?= $user['nom'] ?></h4>
                            <p class="mb-1"><?= $user['prenom'] ?></p>
                            <p class="mb-1"><?= $user['mail'] ?></p>
                            <p class="mb-1 pull-right "><?= $user['login'] ?></p>
                            <p class="mb-1"><?= $user['adherent'] ?></p>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <?php }else{ ?>
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