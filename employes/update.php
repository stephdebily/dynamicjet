<?php
    require 'database.php';

    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }

    if(!empty($_POST)) 
    {
        var_dump($_POST);
        $id =  checkInput($_POST['id_employe']);
        $nom = checkInput($_POST['nom_employe']);
        $dateembauche = checkInput($_POST['dateembauche_employe']);
        $datevisitemedicale = checkInput($_POST['datevisitemedicale_employe']);
        $typecontrat = checkInput($_POST['typecontrat_employe']);
        $permiscotier = checkInput($_POST['permiscotier_employe']);
        $poste = checkInput($_POST['poste_employe']);

        $db = Database::connect();
        $statement = $db->prepare("UPDATE employes  set nom_employe = ?, dateembauche_employe = ?, datevisitemedicale_employe = ?, typecontrat_employe = ?, permiscotier_employe = ?, poste_employe = ? WHERE id_employe = ?");
        $statement->execute(array($nom,$dateembauche,$datevisitemedicale,$typecontrat,$permiscotier,$poste,$id));
        Database::disconnect();
        header("Location: index.php");

    }
    else
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM employes where id_employe = ?");
        $statement->execute(array($id));
        $employe            = $statement->fetch();
        $id                 = $employe['id_employe'];
        $nom                = $employe['nom_employe'];
        $dateembauche       = $employe['dateembauche_employe'];
        $datevisitemedicale = $employe['datevisitemedicale_employe'];
        $typecontrat        = $employe['typecontrat_employe'];
        $permiscotier       = $employe['permiscotier_employe'];
        $poste              = $employe['poste_employe'];
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
                    <h1><strong>Modifier un employé</strong></h1>
                    <br>
                    <form class="form" action="<?php echo 'update.php?id='.$id;?>" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                            <label for="name">Numero de sécurité sociale :</label>
                            <input type="text" class="form-control" id="id_employe" name="id_employe" placeholder="Numéro de sécurité sociale" value="<?php echo $id;?>" required>

                        </div>
                        <div class="form-group">
                            <label for="name">Nom :</label>
                            <input type="text" class="form-control" id="nom_employe" name="nom_employe" placeholder="Nom" value="<?php echo $nom;?>" required>

                        </div>
                        <div class="form-group">
                            <label for="dateembauche_employe">Date embauche :</label>
                            <input type="text" class="form-control" id="dateembauche_employe" name="dateembauche_employe" placeholder="Date D'embauche" value="<?php echo $dateembauche;?>" required>

                        </div>
                        <div class="form-group">
                            <label for="datevisitemedicale_employe">Date visite médicale :</label>
                            <input type="text" class="form-control" id="datevisitemedicale_employe" name="datevisitemedicale_employe" placeholder="Date visite medicale" value="<?php echo $datevisitemedicale;?>" required>

                        </div>
                        <div class="form-group">
                            <label for="">Type contrat :</label>
                            <input type="text" class="form-control" id="typecontrat_employe" name="typecontrat_employe" placeholder="Type de contrat" value="<?php echo $typecontrat;?>" required>

                        </div>
                        <div class="form-group">
                            <label for="">Numero permis cotier :</label>
                            <input type="text" class="form-control" id="permiscotier_employe" name="permiscotier_employe" placeholder="N° permis cotier" value="<?php echo $permiscotier;?>" required>

                        </div>
                        <div class="form-group">
                            <label for="">Poste :</label>
                            <input type="text" class="form-control" id="poste_employe" name="poste_employe" placeholder="Poste" value="<?php echo $poste;?>" required>

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
