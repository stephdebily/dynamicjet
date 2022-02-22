<?php
    require 'database.php';

    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }

    $nomError = $descriptionError = $puissanceError = $etatError = $imageError = $nom = $description = $puissance = $etat = $image = "";

    if(!empty($_POST)) 
    {
        $nom                = checkInput($_POST['nom']);
        $description        = checkInput($_POST['description']);
        $puissance          = checkInput($_POST['puissance']);
        $etat                = checkInput($_POST['etat']); 
        $image              = checkInput($_FILES["image"]["name"]);
        $imagePath          = '../images/'. basename($image);
        $imageExtension     = pathinfo($imagePath,PATHINFO_EXTENSION);
        $isSuccess          = true;
       
        if(empty($nom)) 
        {
            $nomError = 'Ce champ ne peut pas être vide';
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
            $categoryError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($image)) // le input file est vide, ce qui signifie que l'image n'a pas ete update
        {
            $isImageUpdated = false;
        }
        else
        {
            $isImageUpdated = true;
            $isUploadSuccess =true;
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
         
        if (($isSuccess && $isImageUpdated && $isUploadSuccess) || ($isSuccess && !$isImageUpdated)) 
        { 
            $db = Database::connect();
            if($isImageUpdated)
            {
                $statement = $db->prepare("UPDATE equipements  set nom = ?, description = ?, puissance = ?, etat = ?, image = ? WHERE id = ?");
                $statement->execute(array($nom,$description,$puissance,$etat,$image,$id));
            }
            else
            {
                $statement = $db->prepare("UPDATE equipements  set nom = ?, description = ?, puissance = ?, etat = ? WHERE id = ?");
                $statement->execute(array($nom,$description,$puissance,$etat,$id));
            }
            Database::disconnect();
            header("Location: index.php");
        }
        else if($isImageUpdated && !$isUploadSuccess)
        {
            $db = Database::connect();
            $statement = $db->prepare("SELECT * FROM equipements where id = ?");
            $statement->execute(array($id));
            $equipement = $statement->fetch();
            $image          = $equipement['image'];
            Database::disconnect();
           
        }
    }
    else 
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM equipements where id = ?");
        $statement->execute(array($id));
        $equipement     = $statement->fetch();
        $nom            = $equipement['nom'];
        $description    = $equipement['description'];
        $puissance      = $equipement['puissance'];
        $etat           = $equipement['etat'];
        $image          = $equipement['image'];
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
                    <h1><strong>Modifier un équipement</strong></h1>
                    <br>
                    <form class="form" action="<?php echo 'update.php?id='.$id;?>" role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Nom :
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" value="<?php echo $nom;?>">
                            <span class="help-inline"><?php echo $nomError;?></span>
                        </div>
                        <div class="form-group">
                            <label for="description">Description :
                            <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description;?>">
                            <span class="help-inline"><?php echo $descriptionError;?></span>
                        </div>
                        <div class="form-group">
                            <label for="puissance">Puissance (en CV)
                            <input type="number" step="0.01" class="form-control" id="puissance" name="puissance" placeholder="Puissance" value="<?php echo $puissance;?>">
                            <span class="help-inline"><?php echo $puissanceError;?></span>
                        </div>
                        <div class="form-group">
                            <label for="etat">Etat : 
                            <input type="text" class="form-control" id="etat" name="etat" placeholder="etat" value="<?php echo $etat;?>">
                            <span class="help-inline"><?php echo $etatError;?></span>
                        </div>
                        <div class="form-group">
                            <label for="image">Image :</label>
                            <p><?php echo $image;?></p>
                            <label for="image">Sélectionner une nouvelle image :</label>
                            <input type="file" id="image" name="image"> 
                            <span class="help-inline"><?php echo $imageError;?></span>
                        </div>
                        <br>
                        <div class="form-actions">
                            <button type="submit" name="modif" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                            <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                       </div>
                    </form>
                </div>
                <div class="col-sm-6 site">
                    <div class="thumbnail">
                        <img src="<?php echo '../images/'.$image;?>" alt="...">
                        <div class="puissance"><?php echo number_format((float)$puissance, 2, '.', ''). ' CV';?></div>
                          <div class="caption">
                            <h4><?php echo $nom;?></h4>
                            <p><?php echo $description;?></p>
                            <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Réserver</a>
                          </div>
                    </div>
                </div>
            </div>
        </div>   
    </body>
</html>
