<?php

    require 'database.php';
 
    if(!empty($_POST)) 
    {
        $id_employe = checkInput($_POST['id_employe']);
        $nom_employe = checkInput($_POST['nom_employe']);
        $dateembauche_employe = checkInput($_POST['dateembauche_employe']);
        $datevisitemedicale_employe = checkInput($_POST['datevisitemedicale_employe']);
        $typecontrat_employe = checkInput($_POST['typecontrat_employe']);
        $permiscotier_employe = checkInput($_POST['permiscotier_employe']);
        $poste_employe = checkInput($_POST['poste_employe']);
             
        $db = Database::connect();
        $statement = $db->prepare("INSERT INTO employes (id_employe, nom_employe, dateembauche_employe, datevisitemedicale_employe, typecontrat_employe, permiscotier_employe, poste_employe) values(?, ?, ?, ?, ?, ?, ?)");
        $statement->execute(array($id_employe,$nom_employe,$dateembauche_employe,$datevisitemedicale_employe,$typecontrat_employe,$permiscotier_employe,$poste_employe));
        Database::disconnect();
        header("Location: index.php");
        }

    function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>DYNAMIC JET</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="">
    </head>

    <body>
        <h1 class="text-logo"> DYNAMIC JET </span></h1>
         <div class="container admin">
            <div class="row">
                <h1><strong>Ajouter un employé :</strong></h1>
                <br>
                <form class="form" action="insert.php" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="id_employe">Numéro sécurité sociale :</label>
                        <input type="text" class="form-control" id="id_employe" name="id_employe" placeholder="Numéro sécurité sociale" required>
                    </div>
                    <div class="form-group">
                        <label for="nom_employe">Nom :</label>
                        <input type="text" class="form-control" id="nom_employe" name="nom_employe" placeholder="Nom" required>
                    </div>
                    <div class="form-group">
                        <label for="dateembauche_employe">Date embauche :</label>
                        <input type="text" class="form-control" id="dateembauche_employe" name="dateembauche_employe" placeholder="Date D'embauche" required>
                    </div>
                    <div class="form-group">
                        <label for="datevisitemedicale_employe">Date visite médicale :</label>
                        <input type="text" class="form-control" id="datevisitemedicale_employe" name="datevisitemedicale_employe" placeholder="Date visite medicale" required>
                    </div>
                    <div class="form-group">
                        <label for="">Type contrat :</label>
                        <input type="text" class="form-control" id="typecontrat_employe" name="typecontrat_employe" placeholder="Type de contrat" required>
                    </div>
                    <div class="form-group">
                        <label for="">Numero permis cotier :</label>
                        <input type="text" class="form-control" id="permiscotier_employe" name="permiscotier_employe" placeholder="N° permis cotier" required>
                    </div>
                    <div class="form-group">
                        <label for="">Poste :</label>
                        <input type="text" class="form-control" id="poste_employe" name="poste_employe" placeholder="Poste" required>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button>
                        <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                   </div>
                </form>
            </div>
        </div>   
    </body>
</html>