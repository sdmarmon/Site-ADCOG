<?php
require_once "includes/functions.php";
session_start();

// Retrieve offers
if(isUserAdmin()){
    $offers = getDb()->query('SELECT * FROM `offre` WHERE `valide` = 0 ORDER BY `date_validation` DESC');
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
                <div class="table-responsive">
                    <table class="table table-hover table-bordered  text-center">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Titre</th>
                                <th class="text-center">Secteur</th>
                                <th class="text-center">Entreprise</th>
                                <th class="text-center">Date création</th>
                                <th class="text-center">Lieu</th>
                                <th class="text-center col-md-1">Valider</th>
                                <th class="text-center col-md-1" >Rejeter</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($offers as $offer) { ?>
                            <tr>
                                <a href="details_offer.php?id=<?= $offer['offre_id'] ?>">
                                    <th class="text-center" scope="row"><?= $offer['offre_id'] ?></th>
                                    <td><?= $offer['type'] ?></td>
                                    <td><?= $offer['titre'] ?></td>
                                    <td><?= $offer['secteur'] ?></td>
                                    <td><?= $offer['entreprise'] ?></td>
                                    <td><?= timestampToDate($offer['date_creation'])?></td>
                                    <td><?= $offer['lieu'] ?></td>
                                </a>
                                <td>
                                    <form action="update_offer.php" method="post">
                                        <input type="hidden" name="modif" value="1">
                                        <input type="hidden" name="offre_code" value="<?= $offer['offre_id'] ?>">
                                        <button class="btn btn-xs btn-success btn-block" type="submit"><i class="glyphicon glyphicon-ok"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <form action="update_offer.php" method="post">
                                        <input type="hidden" name="modif" value="1">
                                        <input type="hidden" name="offre_code" value="<?= $offer['offre_id'] ?>">
                                        <button class="btn btn-xs btn-danger btn-block" type="submit"><i class="glyphicon glyphicon-remove"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
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