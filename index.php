<?php
require_once "includes/functions.php";
session_start();

// Retrieve offers
if(isUserConnected()){
    $like ="";
    if(isset($_POST['search'])){
        $search = $_POST['search'];
        $like = " AND `titre` LIKE '%".$search."%' ";
    }
    
    $nbOfferByPage=5;
    //7 days delay
    $date_validation = time()-(60*60*24*7);
    if($_SESSION['adherent'] == 0){
        $queryNb ="SELECT COUNT(*) AS nboffer FROM `offre` WHERE `valide` = 1 AND`date_validation` < '".$date_validation.$like."' ORDER BY `date_validation` DESC ";
    }else{
        $queryNb = 'SELECT COUNT(*) AS nboffer FROM `offre` WHERE `valide` = 1 '.$like.' ORDER BY `date_validation` DESC';
    }
    //Get number of offers
    $result = getDb()->query($queryNb);
    $totalOffers = $result->fetch();
    $nbOffers = $totalOffers['nboffer'];
    //Get number of pages needed
    $nbPages = ceil($nbOffers/$nbOfferByPage);

}

?>

<!doctype html>
<html>

    <?php require_once "includes/head.php"; ?>

    <body>
        <div class="container pushFooter">
            <?php require_once "includes/header.php"; ?>
            <?php if(isUserConnected()){ 
    if(isset($_GET['page']))
    {
        $page = $_GET['page'];
    }else{ // Variable doesn't exist, first visit on this page  
        $page = 1; // Page 1 by default
    }

    //Determine the first offer needed
    $firstOffer = ($page - 1) * $nbOfferByPage;
    if($_SESSION['adherent'] == 0){
        $query="SELECT * FROM `offre` WHERE `valide` = 1 AND`date_validation` < '".$date_validation.$like."' ORDER BY `date_validation` DESC LIMIT $firstOffer, $nbOfferByPage";
    }else{
        $query = "SELECT * FROM `offre` WHERE `valide` = 1 ".$like." ORDER BY `date_validation` DESC LIMIT $firstOffer, $nbOfferByPage";
    }
    $offers = getDb()->query($query);
            ?>
            <div>
                <div>
                    <form class="navbar-form" role="search" action="index.php" method="post">
                        <div class="col-sm-3">
                        </div>
                        <div class="input-group col-sm-6">
                            <input type="text" class="form-control" placeholder="Entrez un mot-clé pour rechercher une offre" name="search">
                            <input type="hidden" name="action" value="search">
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
                <?php }else{ ?>
                <div>
                    <div>
                        <img class="img-responsive center-block" src="images/diplomes_adcog.jpg" title="ADCOG Logo" />
                    </div>
                    <div>
                        <h2>Bienvenue sur le site de l'ADCOG</h2>
                        <div>
                            <p>L'association des Diplômés en Cognitique est heureuse de vous présenter la première mise à jour de son système d'information. Nouveau format. Nouveau design. Nouvelles fonctionnalités. Ces améliorations sont les premières d'une longue liste pour fournir de plus en plus d'outils à la hauteur des attentes des anciens de l'<a href="https://ensc.bordeaux-inp.fr/fr" target="_blank">École Nationale Supérieure de Cognitique</a>.
                            </p>
                            <p>Pour nous soutenir dans cette démarche, il vous suffit de vous inscrire via la page <a href="signup.php">Inscription</a>. Si vous êtes déjà inscrit, connectez-vous sur la page <a href="login.php">Connexion</a>.
                            </p>
                        </div>
                        <div class="text-center">
                            <a href="login.php" title="Connexion sur le site de l'ADCOG" class="btn btn-info btn-lg">Connexion</a>
                            <a href="signup.php" title="Inscription à l'ADCOG" class="btn  btn-primary btn-lg">Inscription</a>
                        </div>
                        <br>
                        <h2>Le mot de l'association</h2>
                        <div>
                            <p>Depuis 2007, l'ADCOG ; association des anciens élèves de l'<a href="https://ensc.bordeaux-inp.fr/fr" target="_blank">École Nationale Supérieure de Cognitique</a> et de l'Institut de Cognitique ; facilite le rapprochement des anciens élèves et souhaite promouvoir la prise en compte de l'Homme dans la conception de produits et de services au sein des entreprises. Cela se concrétise notamment par l'organisation d'évènements tels que la Cognito'Conf, où des anciens échangent sur des sujets liés à la Cognitique. De plus, l'ADCOG participe chaque année au Gala de l'ENSC pour rencontrer les nouveaux diplômés et les soutenir lors de leurs premiers pas dans le monde professionnel.
                            </p>
                            <p>Convaincue par l'importance de l'échange entre anciens, l'ADCOG souhaite ralier les jeunes diplômés, à la recherche d'une première expérience professionnelle, tout comme les ingénieurs confirmés souhaitant échanger sur des pratiques ou des concepts auprès de leurs pairs. L'année 2012 marque un tournant dans l'histoire de l'association puisque désormais, le nombre d'anciens est supérieur au nombre d'étudiants au sein de l'ENSC. Il est grand temps d'organiser un réseau de qualité, efficace et solide. Mais cela est impossible sans votre soutien et votre engagement, alors n'attendez plus pour adhérer !
                            </p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>

            <?php require_once "includes/footer.php";?>

            <?php require_once "includes/scripts.php"; ?>
            </body>

        </html>