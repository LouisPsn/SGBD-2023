<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Covoiturage Campus</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <center>
    <h1>
      Véhicules
    </h1>
  </center>
  <?php
  include "menu.php";

  $params = parse_ini_file('../../database.ini');

  $db_handle = pg_connect("host=" . $params['host'] . " port=" . $params['port'] . " password=" . $params['password']);

  $sql = "SELECT * FROM voitures;";
  $result = pg_query($db_handle, $sql);
  ?>

  <div class="container">
    <div class="row justify-content-center">

      <!-- <div class="col-1"></div> -->
      <div class="col">
        <table class="table table-hover table-responsive" id="table_vehicules">
          <thead>
            <tr>
              <th scope="col">ID Voiture</th>
              <th scope="col">Marque</th>
              <th scope="col">Modèle</th>
              <th scope="col">Type</th>
              <th scope="col">Couleur</th>
              <th scope="col">État</th>
              <th scope="col">Divers</th>
              <th scope="col">Conducteur</th>
              <th scope="col">
                <center>Suppression</center>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php

            while ($row = pg_fetch_array($result)) {
              $conducteur = pg_query($db_handle, "SELECT nom, prenom FROM etudiants JOIN voitures ON etudiants.id_etudiant = voitures.id_etudiant WHERE id_voiture = $row[0]");
              $conducteur = pg_fetch_row($conducteur);
              $nom = $conducteur[0];
              $prenom = $conducteur[1];
              echo "<tr>";
              echo "<th scope=\"row\">" . $row[0] . "</th>";
              echo "<td>" . $row[1] . "</td>";
              echo "<td>" . $row[2] . "</td>";
              echo "<td>" . $row[3] . "</td>";
              echo "<td>" . $row[4] . "</td>";
              echo "<td>" . $row[5] . "</td>";
              echo "<td>" . $row[6] . "</td>";
              echo "<td>" . $nom . $prenom . "</td>";
              echo "
              <form id='form-suppresion-voiture' class='d-none' action='delete.php' method='post'>  
                <input type='hidden' name='page' value='vehicules'>
                <input type='hidden' name='table' value='voitures'>
                <input type='hidden' name='nom' value='$nom'>
                <input type='hidden' name='prenom' value='$prenom'>
                <input type='hidden' name='id_voiture' value='$row[0]'>
                
                <!-- Button trigger modal -->
                <td>
                <center>
                <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#passwordModal'>
                  X
                </button>
                </center>
                </td>

                <!-- Modal -->
                <div class='modal fade' id='passwordModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Mot de Passe</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                      </div>
                      <div class='modal-body'>
                      <div class='input-group mb-3'>
                        <input name='mot_de_passe' type='password' class='form-control' placeholder='Mot de Passe*'
                          aria-label='Mot de Passe' aria-describedby='saisie-mot-de-passe'>
                        </div>
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fermer</button>
                        <button type='submit' class='btn btn-danger'>Envoyer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      <!-- <div class="col-1"></div> -->
    </div>
  </div>


</html>