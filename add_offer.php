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
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Titre</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="title" value="" class="form-control" placeholder="Entrez le titre de l'offre" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label ">Type d'offre</label>
                        </div>
                        <div class="col-sm-6">
                            <select name="select" class="form-control">
                                <option value="valeur1" selected>Stage</option> 
                                <option value="valeur2" >Emploi</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Nom de l'entreprise</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="company_name" value="" class="form-control" placeholder="Entrez son réalisateur" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Secteur d'activité</label>
                        </div>
                        <div class="col-sm-6">
                            <textarea name="activity" class="form-control" placeholder="Entrez sa description courte" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Adresse de l'entreprise</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="address" value="" class="form-control" placeholder="Entrez son réalisateur" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Résumé de l'offre</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="resume" value="" class="form-control" placeholder="Entrez son réalisateur" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Détails de l'offre</label>
                        </div>
                        <div class="col-sm-6">
                            <textarea name="details" class="form-control" placeholder="Entrez sa description courte" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Fiche de poste</label>
                        </div>
                        <div class="col-sm-6">
                            <label for="files" class="btn btn-default"><span class="icon-span-filestyle glyphicon glyphicon-folder-open"></span> Choisir un fichier</label>
                            <input id="files" type="file" name="file" class="filestyle pull-right"  style="visibility:hidden;"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Rémunération</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="director" value="" class="form-control" placeholder="Entrez son réalisateur" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Nom du contact</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" name="year" value="" class="form-control" placeholder="Entrez son année de sortie" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">Mail du contact</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" name="year" value="" class="form-control" placeholder="Entrez son année de sortie" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-6 text-center ">
                            <button type="submit" class="btn btn-default btn-primary btn-lg"><span class="glyphicon glyphicon-save"></span> Ajouter</button>
                        </div>
                    </div>
                </form> 
            </div>

            <?php require_once "includes/footer.php"; ?>
        </div>

        <?php require_once "includes/scripts.php"; ?>
    </body>

</html>