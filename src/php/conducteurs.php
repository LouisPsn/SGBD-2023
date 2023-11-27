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
      Conducteurs
    </h1>
  </center>
  <?php
  include "menu.php";

  $params = parse_ini_file('../../database.ini');

  $db_handle = pg_connect("host=" . $params['host'] . " port=" . $params['port'] . " password=" . $params['password']);

  $sql = "SELECT * FROM etudiants;";
  $result = pg_query($db_handle, $sql);
  ?>

  <div class="container">
    <div class="row justify-content-center">

      <!-- <div class="col-1"></div> -->
      <div class="col">
        <table class="table table-hover table-responsive" id="table_joueurs">
          <thead>
            <tr>
              <th scope="col">ID Étudiant</th>
              <th scope="col">Nom</th>
              <th scope="col">Prénom</th>
              <th scope="col">Mail</th>
              <th scope="col">Date de Naissance</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($row = pg_fetch_array($result)) {
              // $result_themes = pg_execute($db_handle, "themes", array($row["id_joueur"]));
              // $themes = listeAttributs($result_themes);
              // $result_mecaniques = pg_execute($db_handle, "mecaniques", array($row["id_joueur"]));
              // $mecaniques = listeAttributs($result_mecaniques);
              echo "<tr>";
              echo "<th scope=\"row\">" . $row[0] . "</th>";
              echo "<td>" . $row[1] . "</td>";
              echo "<td>" . $row[2] . "</td>";
              echo "<td>" . $row[3] . "</td>";
              echo "<td>" . $row[5] . "</td>";
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