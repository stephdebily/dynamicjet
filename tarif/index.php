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
              <h1><strong>Grille tarifaire par équipement selon durée de location </strong><a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
              <hr>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Equipement</th>
                    <th>Tarif de location</th>
                    <th>Durée de location</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                      require 'database.php';
                      $db = Database::connect();
                      $statement = $db->query
                      ('SELECT id_tarif,tarifloc,equipements.nom,dureelocation.temps
                      FROM tariflocation
                      INNER JOIN equipements ON equipements.id = tariflocation.equipement
                      INNER JOIN dureelocation ON dureelocation.id_duree = tariflocation.duree
                      ORDER BY nom ASC');

                      while($tariflocations = $statement->fetch()) 
                      {
                          echo '<tr>';
                          echo '<td>'. $tariflocations['nom'] . '</td>';
                          echo '<td>'. $tariflocations['tarifloc'] . '</td>';  
                          echo '<td>'. $tariflocations['temps'] . '</td>';
                          echo '<td width=250>';
                          echo '<a class="btn btn-primary" href="update.php?id='.$tariflocations['id_tarif'].'"><span class="glyphicon glyphicon-pencil"></span>  Modifier </a>';
                          echo ' ';
                          echo '<a class="btn btn-danger" href="delete.php?id='.$tariflocations['id_tarif'].'"><span class="glyphicon glyphicon-remove"></span>  Supprimer </a>';
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
