<?php
require_once "includes/functions.php";
session_start();

if(isUserConnected()){
    // Search
    $like ="";
    if(isset($_POST['search'])){
        $search = $_POST['search'];
        $like = " AND `titre` LIKE '%".$search."%' ";
    }
    
    $nbOfferByPage=5;
    
    $login = $_SESSION['login'];
    $queryNb = "SELECT COUNT(*) AS nboffer FROM `offre` AS O, `sauvegarder` AS S, `personne` AS P WHERE P.personne_id = S.personne_id AND S.offre_id = O.offre_id AND P.login = '".$login."' ".$like." ORDER BY `date_validation` DESC ";
    // Get number of offers
    $result = getDb()->query($queryNb);
    $totalOffers = $result->fetch();
    $nbOffers = $totalOffers['nboffer'];
    // Get number of pages needed    
    $nbPages = ceil($nbOffers/$nbOfferByPage);
}

?>

<!doctype html>
<html>

    <?php 
    $pageTitle = "Offres favorites";
    require_once "includes/head.php"; 
    ?>

    <body>
        <div class="container pushFooter">
            <?php require_once "includes/header.php"; ?>
            <?php if(isUserConnected()){ 

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{ // Variable doesn't exist, first visit on this page  
        $page = 1; // Page 1 by default
    }

    $firstOffer = ($page - 1) * $nbOfferByPage; // Determine the first offer needed

    $req = "SELECT * FROM `offre` AS O, `sauvegarder` AS S, `personne` AS P WHERE P.personne_id = S.personne_id AND S.offre_id = O.offre_id AND P.login = '".$login."' ".$like." ORDER BY `date_validation` DESC LIMIT $firstOffer, $nbOfferByPage";   
    $offers = getDb()->query($req);
    if($offers->rowCount() >=1){
            ?>
            <div>
                <div>
                    <form class="navbar-form" role="search" method="post">
                        <div class="col-sm-3">
                        </div>
                        <div class="input-group col-sm-6">
                            <input type="text" class="form-control" placeholder="Entrez un mot-clé pour rechercher une offre" name="search">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div> 
                    </form>
                </div>
                <?php foreach ($offers as $offer) { ?>
                <div class="panel panel-info clickable" onclick="document.location='details_offer.php?id=<?= $offer['offre_id'] ?>'">
                    <div class="panel-heading"><h4 class="mb-1 text-primary"><?= $offer['titre'] ?></h4></div>
                    <div class="panel-body">
                        <div class="panel-body pull-left">
                            <strong class="mb-1"><?= $offer['type'] ?></strong>
                            <p class="mb-1"><?= $offer['entreprise'] ?></p>
                            <p class="mb-1">Activité : <?= $offer['secteur'] ?></p>
                            <p class="mb-1">Postée le <?= timestampToDate($offer['date_creation']) ?></p>
                            <p class="mb-1">à <?= $offer['lieu'] ?></p>
                        </div>
                        <div class=""><p class="mb-1"><?=  truncate(nl2br($offer['description'])) ?></p></div>
                    </div>
                </div>
                <?php } ?>
                <div class="text-center">
                    <?php pagination($nbPages,$page); ?>
                </div>
                <?php }else{?>

                <div class="alert alert-info">
                    <p class="text-center"><strong>Vous n'avez aucune offre dans vos favoris.</strong></p>
                </div>
                <div>
                    <br><br>
                    <center><a href="index.php">Revenir à l'accueil.</a></center>
                </div>
                <?php } }else{ ?>
                <div class="alert alert-danger">
                    <p><strong> Attention !</strong> Vous devez vous connecter pour accéder à cette page.</p>
                </div>
                <div>
                    <div class="text-center">
                        <a href="login.php" title="Connexion sur le site de l'ADCOG" class="btn btn-info btn-lg">Connexion</a>
                        <a href="signup.php" title="Inscription à l'ADCOG" class="btn  btn-primary btn-lg">Inscription</a>
                    </div>
                    <br><br>
                    <center><a href="index.php">Revenir à l'accueil.</a></center>
                </div>
                <?php } ?>
            </div>
        </div>
            <?php require_once "includes/footer.php";?>
            <?php require_once "includes/scripts.php"; ?>
    </body>
    
</html>