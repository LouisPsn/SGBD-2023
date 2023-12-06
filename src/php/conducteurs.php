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

  <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/datatables.css" rel="stylesheet">

  <script src="../js/datatables.js"></script>
  <script src="../js/index.js"></script>

  <center>
    <h1>
      Conducteurs
    </h1>
  </center>
  <?php
  include "menu.php";

  $params = parse_ini_file('../../database.ini');

  $db_handle = pg_connect("host=" . $params['host'] . " port=" . $params['port'] . " password=" . $params['password']);

  $sql = "SELECT * FROM etudiants JOIN voitures ON etudiants.id_etudiant = voitures.id_etudiant ORDER BY etudiants.id_etudiant;";
  $result = pg_query($db_handle, $sql);
  ?>

  <div class="container">
    <div class="row justify-content-center">

      <!-- <div class="col-1"></div> -->
      <div class="col">
        <table class="display table table-striped" id="table_conducteurs" style="width:100%">
          <thead>
            <tr>
              <th data-sortable="true" scope="col">ID Étudiant</button></th>
              <th data-sortable="true" scope="col">Nom</th>
              <th data-sortable="true" scope="col">Prénom</th>
              <th data-sortable="true" scope="col">Mail</th>
              <th data-sortable="true" scope="col">Date de Naissance</th>
              <th data-sortable="true" scope="col">Avis</th>
              <th scope="col">
                <center>Suppression</center>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($row = pg_fetch_array($result)) {
              $query = "SELECT AVG(note) FROM avis
              JOIN voyages ON voyages.id_voyage = avis.id_voyage
              JOIN voitures ON voitures.id_voiture = voyages.id_voiture
              WHERE voitures.id_etudiant = $row[0];";
              $avis = pg_query($db_handle, $query);
              echo "<tr>";
              echo "<th scope=\"row\">" . $row[0] . "</th>";
              echo "<td>" . $row[1] . "</td>";
              echo "<td>" . $row[2] . "</td>";
              echo "<td>" . $row[3] . "</td>";
              echo "<td>" . $row[5] . "</td>";
              $note = pg_fetch_row($avis);
              echo "<td>" . number_format($note[0], 2) . "</td>";

              echo "
              <form id='form-suppresion-conducteur".$row[0]."' class='d-none' action='delete.php' method='post'>  
                <input type='hidden' name='page' value='conducteurs'>
                <input type='hidden' name='table' value='etudiants'>
                <input type='hidden' name='id_etudiant' value=$row[0]>
              
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
</body>

</html>