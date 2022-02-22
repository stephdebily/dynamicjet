<?php
    require 'database.php';
    if(!empty($_GET['id'])) 
    {
    $id = checkInput($_GET['id']);
    }
    $db = Database::connect();
    $statement = $db->prepare("SELECT equipements.id, equipements.nom, equipements.description, equipements.puissance, equipements.etat, equipements.image FROM equipements WHERE equipements.id = ?");
    $statement->execute(array($id));
    $equipement = $statement->fetch();
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
                    <h1><strong>Voir un équipement</strong></h1>
                    <br>
                    <form>
                      <div class="form-group">
                        <label>Nom :</label><?php echo '  '.$equipement['nom'];?>
                      </div>
                      <div class="form-group">
                        <label>Description :</label><?php echo '  '.$equipement['description'];?>
                      </div>
                      <div class="form-group">
                        <label>Puissance :</label><?php echo '  '.number_format((float)$equipement['puissance'], 2, '.', ''). ' CV';?>
                      </div>
                      <div class="form-group">
                        <label>Etat :</label><?php echo '  '.$equipement['etat'];?>
                      </div>
                      <div class="form-group">
                        <label>Image :</label><?php echo '  '.$equipement['image'];?>
                      </div>
                    </form>
                    <br>
                    <div class="form-actions">
                      <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div>
                </div> 
                <div class="col-sm-6 site">
                    <div class="thumbnail">
                        <img src="<?php echo '../images/'.$equipement['image'];?>" alt="...">
                        <div class="puissance"><?php echo number_format((float)$equipement['puissance'], 2, '.', ''). ' CV';?></div>
                          <div class="caption">
                            <h4><?php echo $equipement['nom'];?></h4>
                            <p><?php echo $equipement['description'];?></p>
                            <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Réserver</a>
                          </div>
                    </div>
                </div>
            </div>
        </div>   
    </body>
</html>

