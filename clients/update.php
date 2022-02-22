<?php
    require 'database.php';

    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }

    if(!empty($_POST)) 
    {
        $nom              = checkInput($_POST['nom']);
        $prenom           = checkInput($_POST['prenom']);
        $adresse          = checkInput($_POST['adresse']);
        $telephone        = checkInput($_POST['telephone']); 
        $datenaissance    = checkInput($_POST['datenaissance']);
        $numpermiscotier  = checkInput($_POST['numpermiscotier']);
       
        $db = Database::connect();
        $statement = $db->prepare("UPDATE clients  set nom = ?, prenom = ?, adresse = ?, telephone = ?, datenaissance = ?, numpermiscotier = ? WHERE id_client = ?");
        $statement->execute(array($nom,$prenom,$adresse,$telephone,$datenaissance, $numpermiscotier, $id));
        Database::disconnect();
        header("Location: index.php");              
    
    }
    else 
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM clients where id_client = ?");
        $statement->execute(array($id));
        $client             = $statement->fetch();
        $nom                = $client['nom'];
        $prenom             = $client['prenom'];
        $adresse            = $client['adresse'];
        $telephone          = $client['telephone'];
        $datenaissance      = $client['datenaissance'];
        $numpermiscotier    = $client['numpermiscotier'];
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
        <h1 class="text-logo">DYNAMIC JET </span></h1>
         <div class="container admin">
            <div class="row">
                <div class="col-sm-6">
                    <h1><strong>Modifier un client</strong></h1>
                    <br>
                    <form class="form" action="<?php echo 'update.php?id='.$id;?>" role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Nom :
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" value="<?php echo $nom;?>" required>

                        </div>
                        <div class="form-group">
                            <label for="">Prénom :
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="prenom" value="<?php echo $prenom;?>" required>

                        </div>
                        <div class="form-group">
                            <label for="">Adresse :
                            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" value="<?php echo $adresse;?>" required>

                        </div>
                        <div class="form-group">
                        <label for="">telephone :</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Numéro de téléphone" value="<?php echo $telephone;?>" required>

                    </div>
                    <div class="form-group">
                        <label for="">Date de naissance :</label>
                        <input type="date" class="form-control" id="datenaissance" name="datenaissance" placeholder="Date de naissance" value="<?php echo $datenaissance;?>" required>

                    </div>
                    <div class="form-group">
                        <label for="">Permis côtier oui ou non ? </label>
                        <input type="text" class="form-control" id="numpermiscotier" name="numpermiscotier" placeholder="numpermiscotier" value="<?php echo $numpermiscotier;?>" required>

                    </div>
                        <br>
                        <div class="form-actions">
                            <button type="submit" name="modif" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                            <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                       </div>
                    </form>
                </div>
                
            </div>
        </div>   
    </body>
</html>
