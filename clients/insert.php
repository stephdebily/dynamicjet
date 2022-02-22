<?php

    require 'database.php';
 
    if(!empty($_POST)) 
    {
       
        $nom              = checkInput($_POST['nom']);
        $prenom           = checkInput($_POST['prenom']);
        $adresse          = checkInput($_POST['adresse']);
        $telephone        = checkInput($_POST['telephone']); 
        $datenaissance    = checkInput($_POST['datenaissance']);
        $numpermiscotier  = checkInput($_POST['numpermiscotier']);
             
        
        $db = Database::connect();
        $statement = $db->prepare("INSERT INTO clients (nom,prenom,adresse,telephone, datenaissance, numpermiscotier) values(?, ?, ?, ?, ?, ?)");
        $statement->execute(array($nom,$prenom,$adresse,$telephone, $datenaissance, $numpermiscotier));
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
                <h1><strong>Ajouter un client</strong></h1>
                <br>
                <form class="form" action="insert.php" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Nom :</label>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prenom :</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="prenom" required>

                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse :</label>
                        <input type="text" class="form-control" id="Adresse" name="adresse" placeholder="Adresse" required>
                       
                    </div>
                    <div class="form-group">
                        <label for="telephone">telephone :</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Numéro de téléphone" required>
                       
                    </div>
                    <div class="form-group">
                        <label for="name">Date de naissance :</label>
                        <input type="date" class="form-control" id="datenaissance" name="datenaissance" placeholder="Date de naissance" required>
                      
                    </div>
                    <div class="form-group">
                        <label for="name">Permis côtier oui ou non ? </label>
                        <input type="text" class="form-control" id="numpermiscotier" name="numpermiscotier" placeholder="renseigner OUI ou NON" required>
                  
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