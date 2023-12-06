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
  <script src="../js/information.js" defer></script>
  <script src="../js/trajets.js"></script>

  <center>
    <h1>
      Informations
    </h1>
  </center>
  <?php
  include "menu.php";

  $params = parse_ini_file('../../database.ini');

  $db_handle = pg_connect("host=".$params['host']." port=".$params['port']." password=".$params['password']);

  //La liste des véhicules disponibles pour un jour donné pour une ville donnée
  $sql_voitures = "SELECT voitures.id_voiture, etudiants.prenom, etudiants.nom, marque, etapes1.nom, etapes1.date, etapes2.nom, etapes2.date FROM voyages 
  JOIN voitures ON voyages.id_voiture=voitures.id_voiture 
  JOIN etudiants ON voitures.id_etudiant = etudiants.id_etudiant 
  JOIN (SELECT id_etape, etapes.date, nom FROM etapes JOIN villes ON villes.id_ville = etapes.id_ville) as etapes1 ON etapes1.id_etape=voyages.etape_depart_voyage 
  JOIN (SELECT id_etape, etapes.date, nom FROM etapes JOIN villes ON villes.id_ville = etapes.id_ville) as etapes2 ON etapes2.id_etape=voyages.etape_arrive_voyage
  WHERE etapes1.date = '2023-09-10 00:00:00' AND etapes1.nom = 'Bordeaux'
  ;";
  $result_voitures = pg_query($db_handle, $sql_voitures);

  ?>


  <div class="container">
    <div class="row justify-content-center">

      <div class="col">
      <h3>Liste des véhicules pour une date donnée et un lieu donné</h3>
        <table class="display table table-striped" id="table_vehicules" style="width:100%">
          <thead id=entete_vehicules>
            <tr>
              <th scope="col">ID Voiture</th>
              <th scope="col">Conducteur</th>
              <th scope="col">Voiture</th>
              <th scope="col">Lieu et Date de Départ</th>
              <th scope="col">Lieu et Date d'Arrivée</th>
              <th scope="col" class="invisible">motplu</th>
              </th>
            </tr>
          </thead>

          <?php

          function extract_date($date) {
            $ret = "le ".$date[5].$date[6]."/".$date[8].$date[9]."/".$date[0].$date[1].$date[2].$date[3]." à ".$date[10].$date[11]."h".$date[14].$date[15];
            return $ret;
          }

          while($row_voiture = pg_fetch_array($result_voitures)) {

            echo "<tr class='ligne_voyage' id='voyage".$row_voiture[0]."'>";

            echo "<td>".$row_voiture[0]."</td>";
            echo "<td>".$row_voiture[1].$row_voiture[2]."</td>";
            echo "<td>".$row_voiture[3]."</td>";
            echo "<td>".$row_voiture[4].extract_date($row_voiture[5])."</td>";
            echo "<td>".$row_voiture[6].extract_date($row_voiture[7])."</td>";
            echo "<td> </td>";
          }
          ?>
        </table>
      </div>
    </div>
  </div>
</body>

</html>