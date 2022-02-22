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
              <h1><strong>Liste des clients  </strong><a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Nom</th>
                    <th>prenom</th>
                    <th>Adresse</th>
                    <th>Telephone</th>
                    <th>Date de naissance</th>
                    <th>Numéro de permis cotier</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                      require 'database.php';
                      $db = Database::connect();
                      $statement = $db->query('SELECT clients.id_client, clients.nom, clients.prenom, clients.adresse, clients.telephone, clients.datenaissance, clients.numpermiscotier FROM clients ORDER BY clients.id_client DESC');
                      
                      while($client = $statement->fetch()) 
                      
                      {
                          echo '<tr>';
                          echo '<td>'. $client['nom'] . '</td>';
                          echo '<td>'. $client['prenom'] . '</td>';
                          echo '<td>'. $client['adresse'] . '</td>';
                          echo '<td>'. $client['telephone'] . '</td>';
                          echo '<td>'. $client['datenaissance'] . '</td>';
                          echo '<td>'. $client['numpermiscotier'] . '</td>';
                          echo '<td width=300>';
                          echo '<a class="btn btn-default" href="view.php?id='.$client['id_client'].'"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
                          echo ' ';
                          echo '<a class="btn btn-primary" href="update.php?id='.$client['id_client'].'"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                          echo ' ';
                          echo '<a class="btn btn-danger" href="delete.php?id='.$client['id_client'].'"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
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
