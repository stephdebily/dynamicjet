<?php

    require 'database.php';
 
    $nomError = $descriptionError = $puissanceError = $etatError = $imageError = $nom = $description = $puissance = $etat = $image = "";

    if(!empty($_POST)) 
    {
        $nom                = checkInput($_POST['nom']);
        $description        = checkInput($_POST['description']);
        $puissance          = checkInput($_POST['puissance']);
        $etat               = checkInput($_POST['etat']); 
        $image              = checkInput($_FILES["image"]["name"]);
        $imagePath          = '../images/'. basename($image);
        $imageExtension     = pathinfo($imagePath,PATHINFO_EXTENSION);
        $isSuccess          = true;
        $isUploadSuccess    = false;
        
        if(empty($nom)) 
        {
            $nameError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($description)) 
        {
            $descriptionError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
        if(empty($puissance)) 
        {
            $puissanceError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
        if(empty($etat)) 
        {
            $etatError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($image)) 
        {
            $imageError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        else
        {
            $isUploadSuccess = true;
            if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" ) 
            {
                $imageError = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
            if(file_exists($imagePath)) 
            {
                $imageError = "Le fichier existe deja";
                $isUploadSuccess = false;
            }
            if($_FILES["image"]["size"] > 500000) 
            {
                $imageError = "Le fichier ne doit pas depasser les 500KB";
                $isUploadSuccess = false;
            }
            if($isUploadSuccess) 
            {
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) 
                {
                    $imageError = "Il y a eu une erreur lors de l'upload";
                    $isUploadSuccess = false;
                } 
            } 
        }
        
        if($isSuccess && $isUploadSuccess) 
        {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO equipements (nom,description,puissance,etat,image) values(?, ?, ?, ?, ?)");
            $statement->execute(array($nom,$description,$puissance,$etat,$image));
            Database::disconnect();
            header("Location: index.php");
        }
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
                <h1><strong>Ajouter un équipement</strong></h1>
                <br>
                <form class="form" action="insert.php" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Nom :</label>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
                        <span class="help-inline"><?php echo $nomError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Description :</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>
                        <span class="help-inline"><?php echo $descriptionError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="puissance">Puissance (en CV) :</label>
                        <input type="number" step="0.01" class="form-control" id="puissance" name="puissance" placeholder="Puissance" required>
                        <span class="help-inline"><?php echo $puissanceError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="category">Etat :</label>
                        <input type="text" class="form-control" id="etat" name="etat" placeholder="Etat neuf, très bon état, bon état, en maintenance, au rebus" required>
                        <span class="help-inline"><?php echo $etatError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="image">Sélectionner une image :</label>
                        <input type="file" id="image" name="image"> 
                        <span class="help-inline"><?php echo $imageError;?></span>
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