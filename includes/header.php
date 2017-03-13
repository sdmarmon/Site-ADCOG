<?php require_once "includes/functions.php"; ?>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-target">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Accueil</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse-target">
            <ul class="nav navbar-nav">
                <li><a href="add_offer.php">Ajouter une offre</a></li>
                <li><a href="update_offer.php">Modifier une offre</a></li>
                <hr style="border-top:1px solid black">
            </ul>
            <?php if (isUserConnected()) { ?>
                <ul class="nav navbar-nav">
                    <li><a href="movie_add.php">Ajouter un film</a></li>
                </ul>
            <?php } ?>
            <ul class="nav navbar-nav navbar-right">
                <?php if (isUserConnected()) { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span> <?= $_PERSONNE['Nom'] ?> <?= $_PERSONNE['Prenom'] ?> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="logout.php">Se déconnecter</a></li>
                            <li><a href="cart.php">Vos offres favorites</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li><a href="signup.php">Inscription</a></li>
                    <li><a href="login.php">Connexion</a></li>
                <?php } ?>
            </ul>
        </div>
    </div><!-- /.container -->
</nav>
