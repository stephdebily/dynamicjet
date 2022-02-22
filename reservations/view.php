<?php
    require 'database.php';
    if(!empty($_GET['id'])) 
    {
    $id = checkInput($_GET['id']);
    }
    $db = Database::connect();
    $statement = $db->prepare("SELECT reservations.id_reza, reservations.date_deb_reza, reservations.date_fin_reza, reservations.activite, reservations.client, reservations.employe, reservations.equipement, reservations.tarif_reza FROM reservations WHERE reservations.id_reza = ?");
    $statement->execute(array($id));
    $reservation = $statement->fetch();
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
                    <h1><strong>Détail de la réservation</strong></h1>
                    <br>
                    <form>
                      <div class="form-group">
                        <label>Numéro de réservation :</label><?php echo '  '.$reservation['id_reza'];?>
                      </div>
                      <div class="form-group">
                        <label>Date et heure de départ :</label><?php echo '  '.$reservation['date_deb_reza'];?>
                      </div>
                      <div class="form-group">
                        <label>Date et heure de retour :</label><?php echo '  '.$reservation['date_fin_reza'];?>
                      </div>
                      <div class="form-group">
                        <label>Activité :</label><?php echo '  '.$reservation['activite'];?>
                      </div>
                      <div class="form-group">
                        <label>Client :</label><?php echo '  '.$reservation['client'];?>
                      </div>
                      <div class="form-group">
                        <label>Employé Moniteur :</label><?php echo '  '.$reservation['employe'];?>
                      </div>
                      <div class="form-group">
                        <label>Equipement :</label><?php echo '  '.$reservation['equipement'];?>
                      </div>
                      <div class="form-group">
                        <label>Montant total de la réservation (TTC) :</label><?php echo '  '.$reservation['tarif_reza'];?>
                      </div>

                    </form>
                    <br>
                    <div class="form-actions">
                      <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div>
                </div> 
                <div class="col-sm-6 site">
                    <div class="thumbnail">
                        <p>IMPRIMER LA FACTURE</p>
                          <div class="caption">
                            <h4>TVA incluse</h4>
                            
                            <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-print"></span></a>
                          </div>
                    </div>
                </div>
            </div>
        </div>   
    </body>
</html>

