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
      Statistiques
    </h1>
  </center>
  <?php
  include "menu.php";

  $params = parse_ini_file('../../database.ini');

  $db_handle = pg_connect("host=" . $params['host'] . " port=" . $params['port'] . " password=" . $params['password']);
    // $city="SELECT * FROM villes;";
    $city = "SELECT v.nom, COUNT(e.*) as nb FROM villes v, etapes e WHERE e.id_ville = v.id_ville GROUP BY v.nom ORDER BY nb DESC; ";
    $cond = "SELECT e.nom, e.pernom, a.note FROM etudiants e, avis a, voitures v WHERE e.id_etudiant = v.id_etudiant AND e.id_etudiant = a.id_etudiant ORDER BY a.note DESC;";
    $dist = "SELECT AVG(v.distance) FROM voyages v,etapes e GROUP BY e.date ;";
    $sql = "SELECT AVG(COUNT(*)) FROM etudiants e, reservations r, voyages v WHERE e.id_etudiant = r.id_etudiant, r.id_voyage = v.id_voyage AND r.confirmation_reservation = 'accepte'; ";
//   $sql = "SELECT * FROM etudiants LEFT OUTER JOIN voitures ON etudiants.id_etudiant = voitures.id_etudiant WHERE id_voiture is null;";
  $result = pg_query($db_handle, $sql);
  ?>
<?php 
            while ($row = pg_fetch_array($result)) {
                echo "<tr>";
                echo "<th scope=\"row\">" . $row[0] . "</th>";
                echo "<td>" . $row[1] . "</td>";
                echo "<td>" . $row[2] . "</td>";
                echo "<td>" . $row[3] . "</td>";
                echo "<td>" . $row[5] . "</td>";
            }
    ?>
  
</body>
</html>