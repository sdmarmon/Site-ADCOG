<?php
require_once "includes/functions.php";
session_start();

// Retrieve offers
if(isUserAdmin()){
    $offers = getDb()->query('SELECT * FROM `offre` WHERE `valide` = 1');
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
                    <?php foreach ($offers as $offer) { ?>
                    <li class="list-group-item list-group-item-action">
                        <a href="details_offer.php?id=<?= $offer['offre_id'] ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                            <strong class="text-muted pull-right"><?= $offer['type'] ?></strong>
                            <h4 class="mb-1 text-primary"><?= $offer['titre'] ?></h4>
                            <p class="mb-1 pull-right"><?= $offer['secteur'] ?></p>
                            <p class="mb-1"><?= $offer['entreprise'] ?></p>
                            <p class="mb-1 pull-right "><?= timestampToDate($offer['date_creation']) ?></p>
                            <p class="mb-1"><?= $offer['lieu'] ?></p>
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