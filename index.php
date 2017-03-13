<?php
require_once "includes/functions.php";
session_start();

// Retrieve all movies
//$movies = getDb()->query('select * from movie order by mov_id desc'); 
?>

<!doctype html>
<html>

    <?php require_once "includes/head.php"; ?>

    <body>
        <div class="container">
            <?php require_once "includes/header.php"; ?>
            <div>
                <div>
                    <img class="img-responsive center-block" src="images/diplomes_adcog.jpg" title="ADCOG Logo" />
                </div>
                <div>
                    <h2>Bienvenue sur le site de l'ADCOG</h2>
                    <div>
                        <p>L'association des Diplômés en Cognitique est heureuse de vous présenter la première mise à jour de son système d'information. Nouveau format. Nouveau design. Nouvelles fonctionnalités. Ces améliorations sont les premières d'une longue liste pour fournir de plus en plus d'outils à la hauteur des attentes des anciens de l' <a href="/ensc">École Nationale Supérieure de Cognitique</a>.
                        </p>
                        <p>Pour nous soutenir dans cette démarche il vous suffit de vous inscrire via la page <a href="/inscription">Inscription</a> puis d'adhérer via la page <a href="/utilisateur/adhesion">Mon adhésion</a>. Si vous êtes déjà adhérent à l'ADCOG, connectez vous sur le site avec l'identifiant et le mot de passe que nous vous avons fourni sur la page <a href="/connexion">Connexion</a>.
                        </p>
                    </div>
                    <div class="text-center">
                        <a href="/connexion" title="Connexion sur le site de l'ADCOG" class="btn btn-info btn-lg">Connexion</a>
                        <a href="/inscription" title="Inscription à l'ADCOG" class="btn  btn-primary btn-lg">Inscription</a>
                    </div>
                    <br>
                    <h2>Le mot de l'association</h2>
                    <div>
                        <p>Depuis 2007, l'ADCOG, association des anciens élèves de l'<a href="http://www.adcog.fr/ensc">École Nationale Supérieure de Cognitique</a> et de l'<a href="http://www.adcog.fr/ensc">Institut de Cognitique</a>, facilite le rapprochement des anciens élèves et souhaite promouvoir la prise en compte de l'Homme dans la conception de produits et de services au sein des entreprises. Cela se concrétise notamment par l'organisation d'évènements tels que la Cognito'Conf, où des anciens échangent sur des sujets liés à la Cognitique. De plus, l'ADCOG participe chaque année au Gala de l'ENSC pour rencontrer les nouveaux diplômés et les soutenir lors de leurs premiers pas dans le monde professionnel.
                        </p>
                        <p>Convaincue par l'importance de l'échange entre anciens, l'ADCOG souhaite ralier les jeunes diplômés, à la recherche d'une première expérience professionnelle, tout comme les ingénieurs confirmés souhaitant échanger sur des pratiques ou des concepts auprès de leurs pairs. L'année 2012 marque un tournant dans l'histoire de l'association puisque désormais, le nombre d'ancien est supérieur au nombre d'étudiants au sein de l'ENSC. Il est grand temps d'organiser un réseau de qualité, efficace et solide. Mais cela est impossible sans votre soutien et votre engagement, alors n'attendez plus pour adhérer !
                        </p>
                    </div>
                </div>
            </div>
            
        </div>
        <?php require_once "includes/footer.php";?>
        
        <?php require_once "includes/scripts.php"; ?>
    </body>

</html>