<?php
    require 'database.php';
    if(!empty($_GET['id']))
    {
    $id = checkInput($_GET['id']);
    }
    $db = Database::connect();
    $statement = $db->prepare("SELECT id_employe, nom_employe, dateembauche_employe, datevisitemedicale_employe, typecontrat_employe, permiscotier_employe, poste_employe FROM employes WHERE id_employe = ?");
    $statement->execute(array($id));
    $employe = $statement->fetch();
    Database::disconnect();

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
               <div class="col-sm-6">
                    <h1><strong>Voir un salarié</strong></h1>
                    <br>
                    <form>
                      <div class="form-group">
                        <label>Nom :</label><?php echo '  '.$employe['nom_employe'];?>
                      </div>
                      <div class="form-group">
                        <label>Date d'embauche :</label><?php echo '  '.$employe['dateembauche_employe'];?>
                      </div>
                      <div class="form-group">
                         <label>Date visite médicale :</label><?php echo '  '.$employe['datevisitemedicale_employe'];?>
                      </div>
                      <div class="form-group">
                        <label>Type de contrat :</label><?php echo '  '.$employe['typecontrat_employe'];?>
                      </div>
                      <div class="form-group">
                         <label>Numéro permis cotier :</label><?php echo '  '.$employe['permiscotier_employe'];?>
                      </div>
                      <div class="form-group">
                         <label>Poste :</label><?php echo '  '.$employe['poste_employe'];?>
                      </div>
                     </form>
                    <br>
                    <div class="form-actions">
                      <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div>
                </div> 

            </div>
        </div>   
    </body>
</html>

