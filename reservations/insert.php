<?php

    require 'database.php';
 
    if(!empty($_POST)) 
    {
        $depart             = checkInput($_POST['date_deb_reza']);
        $retour             = checkInput($_POST['date_fin_reza']);
        $activite           = checkInput($_POST['activite']);
        $client             = checkInput($_POST['client']); 
        $employe            = checkInput($_POST['employe']);
        $equipement         = checkInput($_POST['equipement']);
        $tarif              = checkInput($_POST['tarif_reza']);     
        
        $db = Database::connect();
        $statement = $db->prepare("INSERT INTO reservations (date_deb_reza,date_fin_reza,activite,client,employe,equipement,tarif_reza) values(?, ?, ?, ?, ?, ?, ?)");
        $statement->execute(array($depart,$retour,$activite,$client,$employe,$equipement,$tarif));
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
                <h1><strong>Ajouter une réservation</strong></h1>
                <br>
                <form class="form" action="insert.php" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Départ :</label>
                        <input type="datetime-local" class="form-control" id="date_deb_reza" name="date_deb_reza" placeholder="Date et heure de départ" required>
                    </div>
                    <div class="form-group">
                        <label for="">Retour :</label>
                        <input type="datetime-local" class="form-control" id="date_fin_reza" name="date_fin_reza" placeholder="Date et Heure de retour" required>
                    </div>
                    <div class="form-group">
                        <label for="">Activité :</label>
                        <input type="text" class="form-control" id="activite" name="activite" placeholder="Activite" required>
                    </div>
                    <div class="form-group">
                        <label for="">Client :</label>
                        <select class="form-control" id="client" name="client" placeholder="Sélectionner le client dans la liste déroulante">
                        <?php
                           $db = Database::connect();
                           foreach ($db->query('SELECT * FROM clients') as $row) 
                           {
                                echo '<option value="'. $row['id_client'] .'">'. $row['name'] . '</option>';
                           }
                           Database::disconnect();
                        ?>
                        </select>
                    <div class="form-group">
                        <label for="">Employé :</label>
                        <input type="text" class="form-control" id="employe" name="employe" placeholder="Sélectionner l'employé dans la liste déroulante" required>
                    </div>
                    <div class="form-group">
                        <label for="">Equipement </label>
                        <input type="text" class="form-control" id="equipement" name="equipement" placeholder="sélectionner l'équipement à réserver" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tarif </label>
                        <input type="text" class="form-control" id="tarif_reza" name="tarif_reza" placeholder="sélectionner le tarif selon la durée de location" required>
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