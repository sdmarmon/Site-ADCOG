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
                                    <form action="update_member.php" method="post">
                                        <input type="hidden" name="modif" value="1">
                                        <input type="hidden" name="offre_code" value="<?= $user['personne_id'] ?>">
                                        <button class="btn btn-xs btn-warning btn-block" type="submit"><i class="glyphicon glyphicon-pencil"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <form action="update_member.php" method="post">
                                        <input type="hidden" name="modif" value="1">
                                        <input type="hidden" name="offre_code" value="<?= $user['personne_id'] ?>">
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