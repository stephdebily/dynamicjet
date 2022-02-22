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
    
        <h1 class="text-logo"> DYNAMIC JET</h1>
        <div class="container admin">
          <div class="row">
              <h1><strong>Liste des réservations </strong><a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Numero de réservation</th>
                    <th>Date et heure du départ</th>
                    <th>Date et heure du retour</th>
                    <th>Activité</th>
                    <th>Client</th>
                    <th>Employé Moniteur</th>
                    <th>Equipement loué</th>
                    <th>Montant total de la réservation</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                      require 'database.php';
                      $db = Database::connect();
                      $statement = $db->query
                      ('SELECT id_reza, date_deb_reza, date_fin_reza, activite, clients.nom AS nom_client, clients.prenom, employes.nom_employe, equipements.nom AS nom_equipement, tariflocation.tarifloc
                      FROM reservations
                      INNER JOIN clients ON clients.id_client = reservations.client
                      INNER JOIN employes ON employes.id_employe = reservations.employe
                      INNER JOIN equipements ON equipements.id = reservations.equipement
                      INNER JOIN tariflocation ON tariflocation.id_tarif = reservations.tarif_reza
                      ORDER BY id_reza DESC');

                      while($reservation = $statement->fetch()) 
                      {
                          echo '<tr>';
                          echo '<td>'. $reservation['id_reza'] . '</td>';
                          echo '<td>'. $reservation['date_deb_reza'] . '</td>';
                          echo '<td>'. $reservation['date_fin_reza'] . '</td>';
                          echo '<td>'. $reservation['activite'] . '</td>';
                          echo '<td>'. $reservation['nom_client'] .' '.$reservation['prenom'] . '</td>';  
                          echo '<td>'. $reservation['nom_employe'] . '</td>';  
                          echo '<td>'. $reservation['nom_equipement'] . '</td>';
                          echo '<td>'. $reservation['tarifloc'] . '</td>';
                          echo '<td width=300>';
                          echo '<a class="btn btn-default" href="view.php?id='.$reservation['id_reza'].'"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
                          echo ' ';
                          echo '<a class="btn btn-primary" href="update.php?id='.$reservation['id_reza'].'"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                          echo ' ';
                          echo '<a class="btn btn-danger" href="delete.php?id='.$reservation['id_reza'].'"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                          echo '</td>';
                          echo '</tr>';
                       }
                      Database::disconnect();
                    ?>
                </tbody>
              </table>
          </div>
      </div>
  </body>
</html>
