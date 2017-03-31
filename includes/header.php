<?php require_once "includes/functions.php"; ?>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-target">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand blue" href="index.php">Accueil</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse-target">
            <ul class="nav navbar-nav">
                <li><a href="add_offer.php" class="blue">Ajouter une offre</a></li>
                <li><a href="update_offer.php" class="blue">Modifier une offre</a></li>
                <hr style="border-top:1px solid black">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if (isUserConnected()) { ?>
                    <?php if (isUserAdmin()) { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo 'Administration'; ?> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="admin_members.php">Membres</a></li>
                                <li><a href="admin_offers.php">Offres</a></li>
                                <li><a href="admin_validate.php">Validation</a></li>
                            </ul>
                        </li>                        
                    <?php } ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['prenom'] ?> <?php echo $_SESSION['nom'] ?> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="fav_offers.php">Offres favorites</a></li>
                                <li><a href="my_offers.php">Offres créees</a></li>
                                <li><a href="logout.php">Déconnexion</a></li>
                            </ul>
                        </li>
                    
                <?php } else { ?>
                    <li><a href="signup.php" class="blue">Inscription</a></li>
                    <li><a href="login.php" class="blue">Connexion</a></li>
                <?php } ?>
            </ul>
        </div>
    </div><!-- /.container -->
</nav>
