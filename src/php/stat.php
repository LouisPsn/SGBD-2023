<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Covoiturage Campus</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="../js/index.js"></script>
  <center>
    <h1>
      Statistiques
    </h1>
  </center>

  <?php
  include "menu.php";

  $params = parse_ini_file('../../database.ini');
  $db_handle = pg_connect("host=" . $params['host'] . " port=" . $params['port'] . " password=" . $params['password']);
  ?>

  &nbsp;
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3 align-self-start">
        <form method="get">
          <select class="form-select" id="selection" onchange="changerAffichageStats()">
            <option value="classement_villes" selected>Classement des villes</option>
            <option value="classement_conducteurs">Classement des conducteurs</option>
            <option value="moyenne_passagers">Moyenne des passagers par voyage</option>
            <option value="moyenne_distances">Moyenne des distances effectuées</option>
          </select>
        </form>
      </div>
    </div>
    &nbsp;

    <div class="container">
      <div class="row justify-content-center">

        <div class="col" id="stat1">
          <h3>Classement des villes</h3>
          <table class="table table-hover table-responsive" id="table_stats1">
            <thead>
              <tr>
                <th scope="col">Villes</th>
                <th scope="col">Nb étapes</th>

              </tr>
            </thead>
            <tbody>
              <?php
              $city = "SELECT v.nom, COUNT(e.*) as nb FROM villes v, etapes e WHERE e.id_ville = v.id_ville GROUP BY v.nom ORDER BY nb DESC; ";
              $result = pg_query($db_handle, $city);
              ?>
              <?php
              while ($row = pg_fetch_array($result)) {
                echo "<tr>";
                echo "<td scope=\"row\">" . $row[0] . "</th>";
                echo "<td>" . $row[1] . "</td>";
                echo "<tr>";
              }
              ?>
            </tbody>
          </table>
        </div>


        <div class="d-none" id="stat2">
          <h3>Classement des conducteurs</h3>
          <table class="table table-hover table-responsive" id="table_stats2">
            <thead>
              <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Notes</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $haha = "SELECT e.nom, e.prenom, AVG(a.note) as moy from etudiants e, avis a, voitures v WHERE a.id_etudiant = e.id_etudiant AND v.id_etudiant = e.id_etudiant GROUP BY e.id_etudiant ORDER BY moy DESC ;";
              $resulto = pg_query($db_handle, $haha);

              ?>
              <?php

              while ($row = pg_fetch_array($resulto)) {
                echo "<tr>";
                echo "<td scope=\"row\">" . $row[0] . "</th>";
                echo "<td>" . $row[1] . "</td>";
                echo "<td>" . number_format($row[2], 2) . "</td>";
                echo "<tr>";
              }
              ?>
            </tbody>
          </table>
        </div>


        <div class="d-none" id="stat3">
          <h3>Moyenne des passagers par voyage</h3>
          <table class="table table-hover table-responsive" id="table_stats3">
            <thead>
              <tr>
                <th scope="col">Nombre de passagers moyen</th>
                <!-- <th scope="col">Notes</th> -->
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT nb_pass.*  FROM (SELECT count(e.*)  FROM etudiants e, reservations r, voyages v, etapes et WHERE e.id_etudiant = r.id_etudiant AND r.id_voyage = v.id_voyage AND v.etape_arrive_voyage = et.id_etape AND et.date < NOW() AND r.confirmation_reservation = 'accepte') as nb_pass; ";
              // $sql = "SELECT nb_pass.*  FROM (SELECT count(e.*)  FROM etudiants e, reservations r, voyages v WHERE e.id_etudiant = r.id_etudiant AND r.id_voyage = v.id_voyage AND r.confirmation_reservation = 'accepte') as nb_pass; ";
              $voy = "SELECT count(*) FROM voyages;";
              $resulto = pg_query($db_handle, $sql);
              $ressss = pg_query($db_handle, $voy);
              ?>
              <?php
              $row = pg_fetch_array($resulto);
              $rr = pg_fetch_array($ressss);
              echo "<tr>";
              $avg = number_format($row[0]/$rr[0], 2);
              echo "<td>$avg</td>";
              ?>
            </tbody>
          </table>
        </div>

        <div class="d-none" id="stat4">
          <h3>Moyenne des distances effectuées</h3>
          <table class="table table-hover table-responsive" id="table_stats4">
            <thead>
              <tr>
                <th scope="col">Distance</th>
                <th scope="col">Dates</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $dist = "SELECT AVG(v.distance) as vroom , e.date FROM voyages v,etapes e WHERE e.id_etape = v.etape_arrive_voyage AND e.date < NOW() GROUP BY e.date ORDER BY vroom;";


              $resulto = pg_query($db_handle, $dist);

              ?>
              <?php

              while ($row = pg_fetch_array($resulto)) {
                echo "<tr>";
                echo "<td>" . number_format($row[0], 2) . " km</td>";
                echo "<td>" . $row[1] . "</td>";
                echo "<tr>";
              }
              ?>
            </tbody>
          </table>
        </div>


      </div>
    </div>
</body>

</html>