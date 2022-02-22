<?php
    require 'database.php';
    if(!empty($_GET['id'])) 
    {
    $id = checkInput($_GET['id']);
    }
    $db = Database::connect();
    $statement = $db->prepare("SELECT clients.id_client, clients.nom, clients.prenom, clients.adresse, clients.telephone, clients.datenaissance, clients.numpermiscotier FROM clients WHERE clients.id_client = ?");
    $statement->execute(array($id));
    $client = $statement->fetch();
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
                    <h1><strong>Voir un client</strong></h1>
                    <br>
                    <form>
                      <div class="form-group">
                        <label>Nom :</label><?php echo '  '.$client['nom'];?>
                      </div>
                      <div class="form-group">
                        <label>Prenom :</label><?php echo '  '.$client['prenom'];?>
                      </div>
                      <div class="form-group">
                    <label>Adresse :</label><?php echo '  '.$client['adresse'];?>
                      </div>
                      <div class="form-group">
                        <label>Telephone :</label><?php echo '  '.$client['telephone'];?>
                      </div>
                      <div class="form-group">
                      <label>Date de naissance :</label><?php echo '  '.$client['datenaissance'];?>
                      </div>
                      <div class="form-group">
                      <label>Numero de permis côtier :</label><?php echo '  '.$client['numpermiscotier'];?>
                      </div>
                    </form>
                    <br>
                    <div class="form-actions">
                      <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div>
                </div> 
                <div class="col-sm-6 site">
                    <div class="thumbnail">
                          <div class="caption">
                            <h4>FONCTION CONSULTATION DES RESERVATIONS : </h4>
                            <p>avec historique des réservations passées et à venir</p>
                            <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                          </div>
                    </div>
                </div>
                </div>
            </div>
        </div>   
    </body>
</html>

