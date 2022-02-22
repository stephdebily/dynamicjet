<?php
    require 'database.php';

    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }

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
        $statement = $db->prepare("UPDATE reservations set date_deb_reza = ?, date_fin_reza = ?, activite = ?, client = ?, employe = ?, equipement = ?, tarif_reza = ? WHERE id_reza = ?");
        $statement->execute(array($depart,$retour,$activite,$client,$employe,$equipement,$tarif,$id));
        Database::disconnect();
        header("Location: index.php");              
    }
    else 
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM reservations where id_reza = ?");
        $statement->execute(array($id));
        $reservation        = $statement->fetch();
        $depart             = $reservation['date_deb_reza'];
        $retour             = $reservation['date_fin_reza'];
        $activite           = $reservation['activite'];
        $client             = $reservation['client'];
        $employe            = $reservation['employe'];
        $equipement         = $reservation['equipement'];
        $tarif              = $reservation['tarif_reza'];
        Database::disconnect();
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
    <h1 class="text-logo"> DYNAMIC JET </h1>
    <div class="container admin">
        <div class="row">
            <h1><strong> Modifier la réservation </strong></h1>
            <br>
            <form class="form" action="<?php echo 'update.php?id='.$id;?>" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Numéro de la réservation :
                        <input type="text" class="form-control" id="id_reza" name="id_reza" placeholder="" value="<?php echo $id;?>">
                    </div>
                    <div class="form-group">
                        <label for="">Date et heure de départ :
                        <input type="text" class="form-control" id="date_deb_reza" name="date_deb_reza" placeholder="" value="<?php echo $depart;?>"required>
                    </div>
                    <div class="form-group">
                        <label for="">Date et heure de départ :
                        <input type="text" class="form-control" id="date_fin_reza" name="date_fin_reza" placeholder="" value="<?php echo $retour;?>"required>
                    </div>
                    <div class="form-group">
                        <label for="">Activite :
                        <input type="text" class="form-control" id="activite" name="activite" placeholder="" value="<?php echo $activite;?>"required>
                    </div>
                     <div class="form-group">
                        <label for="">Client :
                        <input type="text" class="form-control" id="client" name="client" placeholder="" value="<?php echo $client;?>"required>
                    </div>
                    <div class="form-group">
                        <label for="">Employe Moniteur :
                        <input type="text" class="form-control" id="employe" name="employe" placeholder="" value="<?php echo $employe;?>"required>
                    </div>
                    <div class="form-group">
                        <label for="">Equipement loué :
                        <input type="text" class="form-control" id="equipement" name="equipeement" placeholder="" value="<?php echo $equipement;?>"required>
                    </div>
                    <div class="form-group">
                        <label for="">Montant de la réservation TTC :
                        <input type="text" class="form-control" id="equipement" name="equipement" placeholder="" value="<?php echo $tarif;?>"required>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" name="modif" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                        <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                </div>
                </form>
        </div>
    </div>   
</body>
</html>

