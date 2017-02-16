<?php
require_once "includes/functions.php";
session_start();

// Retrieve offers 
$login = $_SESSION['login'];
$query ="select * from personne, sauvegarder, offre WHERE personne.personne_id = sauvegarder.personne_id  AND sauvegarder.offre_id = offre.offre_id AND personne.login ='$login'";
$offers = getDb()->query($query); 
?>

<!doctype html>
<html>

<?php require_once "includes/head.php"; ?>

<body>
    <div class="container">
        <?php require_once "includes/header.php"; ?>
        
        <?php foreach ($offers as $offer) { ?>
            <article>
                <h3><a class="movieTitle" href="movie.php?id=<?= $offer['offre_id'] ?>"><?= $offer['titre'] ?></a></h3>
                <p class="movieContent"><?= $offer['description'] ?></p>
            </article>
        <?php } ?>

        <?php require_once "includes/footer.php"; ?>
    </div>

    <?php require_once "includes/scripts.php"; ?>
</body>

</html>