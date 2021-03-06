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
              <h1><strong>Liste des employes </strong><a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Nom</th>
                    <th>Date d'embauche</th>
                    <th>Date visite médicale</th>
                    <th>Type de contrat</th>
                    <th>Num permis cotier</th>
                    <th>Poste</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                      require 'database.php';
                      $db = Database::connect();
                      $statement = $db->query('SELECT id_employe, nom_employe, dateembauche_employe, datevisitemedicale_employe, typecontrat_employe, permiscotier_employe, poste_employe FROM employes ORDER BY id_employe DESC');
                      while($employe = $statement->fetch())
                      {
                          echo '<tr>';
                          echo '<td>'. $employe['nom_employe'] . '</td>';
                          echo '<td>'. $employe['dateembauche_employe'] . '</td>';
                          echo '<td>'. $employe['datevisitemedicale_employe'] . '</td>';
                          echo '<td>'. $employe['typecontrat_employe'] . '</td>';
                          echo '<td>'. $employe['permiscotier_employe'] . '</td>';
                          echo '<td>'. $employe['poste_employe'] . '</td>';
                          echo '<td width=300>';
                          echo '<a class="btn btn-default" href="view.php?id='.$employe['id_employe'].'"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
                          echo ' ';
                          echo '<a class="btn btn-primary" href="update.php?id='.$employe['id_employe'].'"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                          echo ' ';
                          echo '<a class="btn btn-danger" href="delete.php?id='.$employe['id_employe'].'"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
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
