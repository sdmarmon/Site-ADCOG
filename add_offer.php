<?php
require_once "includes/functions.php";
session_start();

?>

<!doctype html>
<html>

    <?php 
    $pageTitle = "Ajouter une offre";
    require_once "includes/head.php"; 
    ?>

    <body>
        <div class="container">
            <?php require_once "includes/header.php"; ?>
            <h2 class="text-center">Ajouter une offre</h2>

            <div class="well">
                <form class="form-horizontal" role="form" enctype="multipart/form-data" action="movie_add.php" method="post">
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Titre</label>
                        <div class="col-sm-6">
                            <input type="text" name="title" value="" class="form-control" placeholder="Entrez le titre de l'offre" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Type d'offre</label>
                        <div class="col-sm-6">
                            <select name="select">
                                <option value="valeur1">Valeur 1</option> 
                                <option value="valeur2" selected>Valeur 2</option>
                                <option value="valeur3">Valeur 3</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nom de l'entreprise</label>
                        <div class="col-sm-6">
                             <input type="text" name="company_name" value="" class="form-control" placeholder="Entrez son réalisateur" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Secteur d'activité</label>
                        <div class="col-sm-6">
                            <textarea name="activity" class="form-control" placeholder="Entrez sa description courte" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Adresse de l'entreprise</label>
                        <div class="col-sm-6">
                             <input type="text" name="address" value="" class="form-control" placeholder="Entrez son réalisateur" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Résumé de l'offre</label>
                        <div class="col-sm-6">
                             <input type="text" name="resume" value="" class="form-control" placeholder="Entrez son réalisateur" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Détails de l'offre</label>
                        <div class="col-sm-6">
                              <textarea name="details" class="form-control" placeholder="Entrez sa description courte" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Fiche de poste</label>
                        <div class="col-sm-6">
                            <label for="files" class="btn btn-default">Choisir un fichier</label>
                            <input id="files" type="file" name="file" class="filestyle"  style="visibility:hidden;"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Rémunération</label>
                        <div class="col-sm-6">
                            <input type="text" name="director" value="" class="form-control" placeholder="Entrez son réalisateur" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nom du contact</label>
                        <div class="col-sm-6">
                            <input type="number" name="year" value="" class="form-control" placeholder="Entrez son année de sortie" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Mail du contact</label>
                        <div class="col-sm-6">
                            <input type="number" name="year" value="" class="form-control" placeholder="Entrez son année de sortie" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-4">
                            <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-save"></span> Enregistrer</button>
                        </div>
                    </div>
                </form> 
            </div>

            <?php require_once "includes/footer.php"; ?>
        </div>

        <?php require_once "includes/scripts.php"; ?>
    </body>

</html>