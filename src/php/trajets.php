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

  <link href="../style/trajets.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/datatables.css" rel="stylesheet">
  <script src="../js/datatables.js"></script>
  <script src="../js/trajets.js" defer></script>

  <center>
    <h1>
      Trajets
    </h1>
  </center>
  <?php
  include "menu.php";

  $params = parse_ini_file('../../database.ini');

  $db_handle = pg_connect("host=" . $params['host'] . " port=" . $params['port'] . " password=" . $params['password']);

  // $sql_voyages = "SELECT * FROM voyages;";
  $sql_voyages =
    /* "select voy_with_dep.* etape2.* from (select voyages.id_voyage as id_voyage, etape1.*,voyages.etape_arrive_voyage as etape_arrive_voyage from (SELECT id_etape, etapes.date, nom FROM etapes JOIN villes ON villes.id_ville = etapes.id_ville) as etape1 join voyages on voyages.etape_depart_voyage = etape1.id_etape) as voy_with_dep join (SELECT id_etape, etapes.date, nom FROM etapes JOIN villes ON villes.id_ville = etapes.id_ville) as etape2 on etape2.id_etape=voy_with_dep.etape_arrive_voyage"; */
    /* 
    "SELECT id_voyage, etape1.id_etape, etape1.date, etape1.nom FROM voyage v, (SELECT id_etape, etapes.date, nom FROM etapes JOIN villes ON villes.id_ville = etapes.id_ville) as etape1 WHERE voyage.etape_depart_voyage = etape1.id_etape;";
   */
    /*  "SELECT * FROM (SELECT id_voyage , prenom , modele, couleur , etapes1.nom, etapes1.date, etape_arrive_voyage FROM voyages 
     JOIN voitures ON voyages.id_voiture=voitures.id_voiture 
     JOIN etudiants ON voitures.id_etudiant = etudiants.id_etudiant 
     JOIN (SELECT id_etape, etapes.date, nom FROM etapes JOIN villes ON villes.id_ville = etapes.id_ville) as etapes1 ON etapes1.id_etape=voyages.etape_depart_voyage) as voy_dep 
     JOIN (SELECT id_etape, etapes.date, nom FROM etapes JOIN villes ON villes.id_ville = etapes.id_ville) as etapes2 ON etapes2.id_etape=voy_dep.etape_arrive_voyage
      ;"; */

    "SELECT id_voyage , etudiants.nom, prenom , modele, couleur , etapes1.nom, etapes1.date, /* etape_arrive_voyage */  etapes2.nom, etapes2.date, etudiants.id_etudiant, nombre_places FROM voyages 
JOIN voitures ON voyages.id_voiture=voitures.id_voiture 
JOIN etudiants ON voitures.id_etudiant = etudiants.id_etudiant 
JOIN (SELECT id_etape, etapes.date, nom FROM etapes JOIN villes ON villes.id_ville = etapes.id_ville) as etapes1 ON etapes1.id_etape=voyages.etape_depart_voyage 
JOIN (SELECT id_etape, etapes.date, nom FROM etapes JOIN villes ON villes.id_ville = etapes.id_ville) as etapes2 ON etapes2.id_etape=voyages.etape_arrive_voyage
 ;";
  $result_voyages = pg_query($db_handle, $sql_voyages);
  ?>


  <div class="container">
    <div class="row justify-content-center">

      <!-- <div class="col-1"></div> -->
      <div class="col">
        <table class="display table table-striped" id="table_trajets" style="width:100%">
          <thead id=entete_trajets>
            <tr>
              <th scope="col">Voyage</th>
              <th scope="col">Conducteur</th>
              <th scope="col">Voiture</th>
              <th scope="col">Lieu et Date de Départ</th>
              <th scope="col">Lieu et Date d'Arrivée</th>
              <th scope="col" class="invisible">motplu</th>
              <th scope="col"></th>
              <!-- <th scope="col">Avis</th> -->
              <th scope="col">
                <center>Suppression</center>
              </th>
            </tr>
          </thead>
          <!-- 
          <tr class="voyage"><td>1</td><td>Max</td><td>Clio noire</td><td>Bordeaux 15h</td><td>Ibiza 15h30</td></tr>

          <tr class="reservation-header"><td> </td><td>Reservation</td><td>Passager</td><td>Etape départ</td><td>Etape arrivée</td><td>Status</td><td>Suppression</td></tr> -->

          <!-- <tbody> -->
          <?php

          function extract_date($date)
          {
            $ret = "le " . $date[5] . $date[6] . "/" . $date[8] . $date[9] . "/" . $date[0] . $date[1] . $date[2] . $date[3] . " à " . $date[10] . $date[11] . "h" . $date[14] . $date[15];
            return $ret;
          }

          // echo "<tr> <td> Avant </td> </tr>";
          while ($row_voyage = pg_fetch_array($result_voyages)) {

            // echo "<tr>";
            // echo "<th scope=\"row\">" . $row_voyage[0] . "</th>";
            // for ($i=1; $i < 26; $i++) { 
            //   # code...
            //   echo "<td>" . $row_voyage[$i] . "</td>";
            // }
            // echo "</tr>";
            // echo "<tr>";
            // echo "<div class='voyage-complet'>";
            echo "<tr class='ligne_voyage' id='voyage" . $row_voyage[0] . "'>";

            echo "<td>" . $row_voyage[0] . "</td>";
            echo "<td>" . $row_voyage[1] . $row_voyage[2] . "</td>";
            echo "<td>" . $row_voyage[3] . $row_voyage[4] . "</td>";
            echo "<td>" . $row_voyage[5] . $row_voyage[6] . "</td>";
            echo "<td>" . $row_voyage[7] . $row_voyage[8] . "</td>";
            echo "<td> </td>";
            echo "<td> <button class='bouton_resa' id='resa_voyage" . $row_voyage[0] . "'>Show Resa</button> </td>";

            echo "
                              <form id='form-suppresion-voyage" . $row_voyage[0] . "' class='d-none' action='delete.php' method='post'>  
                              <input type='hidden' name='id' value='form-suppresion-voyage" . $row_voyage[0] . "'>  
                              <input type='hidden' name='page' value='trajets'>
                                <input type='hidden' name='table' value='voyages'>
                                <input type='hidden' name='id_voyage' value=$row_voyage[0]>
                                <input type='hidden' name='id_etudiant' value=$row_voyage[9]>
                              
                                <!-- Button trigger modal -->
                                <td>
                                <center>
                                <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#passwordModalVoyage'>
                                  X
                                </button>
                                </center>
                                </td>
                              
                                <!-- Modal -->
                                <div class='modal fade' id='passwordModalVoyage' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
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
            /* 
                          for ($i=0; $i < 25; $i++) { 
                                
                                echo "<td>" . $row_voyage[$i] . "</td>";
                              }
            */
            // echo "<tr> <td> Après </td> </tr>";
          
            echo "<tr class='reservation-header resa resa_voyage" . $row_voyage[0] . "'><td> </td><td>Reservation</td><td>Passager</td><td>Etape départ</td><td>Etape arrivée</td><td>Prix proposé</td><td>Status</td><td>Suppression</td></tr>";


            $query_resa_du_voyage = "SELECT id_reservation, prenom, etape1.nom, etape2.nom, proposition_prix, confirmation_reservation, resa.id_etudiant FROM (SELECT id_reservation , prenom, etape_depart_resa, etape_arrive_resa, proposition_prix, confirmation_reservation, etudiants.id_etudiant FROM reservations
              -- JOIN etudiants ON etudiants.id_etudiant = reservations.id_voyage
              JOIN etudiants ON reservations.id_etudiant = etudiants.id_etudiant
              JOIN voyages ON voyages.id_voyage = reservations.id_voyage
              JOIN voitures ON voitures.id_voiture = voyages.id_voiture
              WHERE voyages.id_voyage = $row_voyage[0]) as resa 
              JOIN (SELECT id_etape, nom FROM etapes JOIN villes ON villes.id_ville = etapes.id_ville) as etape1 ON etape1.id_etape=resa.etape_depart_resa
              JOIN (SELECT id_etape, nom FROM etapes JOIN villes ON villes.id_ville = etapes.id_ville) as etape2 ON etape2.id_etape=resa.etape_arrive_resa
              ;";
            $res_resa_du_voyage = pg_query($db_handle, $query_resa_du_voyage);
            while ($row_resa = pg_fetch_array($res_resa_du_voyage)) {

              //   // function_alert($row[1]);
              echo "<tr class ='resa resa_voyage" . $row_voyage[0] . "'><td> </td>";

              //   // echo "<th scope=\"row\">" . $row_resa[0] . "</th>";
              //   // echo "<td>" . $row_resa[10] . "</td>";
              //   // echo "<td>" . $row_resa[5] . "</td>";
              //   // echo "<td>" . $row_resa[6] . "</td>";
              //   // echo "<td>" . $row_resa[2] . "</td>";
          
              for ($i = 0; $i < 5; $i++) {
                # code...
                echo "<td>" . $row_resa[$i] . "</td>";
              }
              if ($row_resa[5] == "refuse") {
                echo "<td>Refusé</td>";
              } else if ($row_resa[5] == "accepte") {
                echo "<td>Accepté</td>";
              } else if ($row_resa[5] == "attente") {
                echo "<td>En Attente</td>";
              }


              echo "
              <form id='form-suppresion-resa" . $row_resa[0] . "' class='d-none' action='delete.php' method='post'>
                <input type='hidden' name='page' value='trajets'>
                <input type='hidden' name='table' value='reservations'>
                <input type='hidden' name='id_etudiant' value=$row_resa[6]>
                <input type='hidden' name='id_reservation' value=$row_resa[0]>
              
                <!-- Button trigger modal -->
                <td>
                <center>
                <button type='button' class=' btn_smaller' data-bs-toggle='modal' data-bs-target='#passwordModalResa'>
                  <span>X</span>
                </button>
                </center>
                </td>
              
                <!-- Modal -->
                <div class='modal fade' id='passwordModalResa' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
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
            // echo "</div>";
            // echo "</tr>";
            // echo "<tr> </tr>";
          
            // Ajout réservations
            $query = "SELECT COUNT(id_reservation) FROM reservations JOIN voyages ON voyages.id_voyage = reservations.id_voyage WHERE voyages.id_voyage = $row_voyage[0] AND  reservations.confirmation_reservation = 'accepte';";
            $resultat = pg_query($db_handle, $query);
            $count_resa = pg_fetch_array($resultat);

            if ($row_voyage[10] - $count_resa[0] > 0) {
              echo "
              <form id='form-ajout-resa' class='d-none' action='insert.php' method='post'>
                <input type='hidden' name='page' value='trajets'>
                <input type='hidden' name='table' value='reservations'>
                <input type='hidden' name='id_voyage' value=$row_voyage[0]>
              
                <!-- Button trigger modal -->
                <td>
                <center>
                <button type='button' class='btn btn btn-dark' data-bs-toggle='modal' data-bs-target='#passwordModalResaAjj'>
                  <span>Ajouter une réservation</span>
                </button>
                </center>
                </td>
              
                <!-- Modal -->
                <div class='modal fade' id='passwordModalResaAjj' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Mot de Passe</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                      </div>
                      <div class='modal-body'>

                      <div class='input-group mb-3'>
                        <select name='id_etudiant' class='form-select' aria-label='Default select example'>
                          <option selected>Sélectionner un étudiant</option>
                          ";
                          $query = "SELECT * FROM etudiants LEFT OUTER JOIN voitures ON etudiants.id_etudiant = voitures.id_etudiant WHERE id_voiture is null ORDER BY nom;";
                          $result = pg_query($db_handle, $query);
                          while ($row = pg_fetch_array($result)) {
                            echo "<option value=$row[0]>$row[1] $row[2]</option>";
                          }
                          echo "
                        </select>
                      </div>
                        <div class='input-group mb-3'>
                        <input name='prix' type='text' class='form-control' placeholder='Prix*'
                          aria-label='Prix' aria-describedby='saisie-date-prix'>
                        </div>
                        <div class='input-group mb-3'>
                          Étape de départ
                        </div>
                        <div class='input-group mb-3'>
                          <input name='date_depart' type='datetime-local' class='form-control' placeholder='Date de départ*'
                            aria-label='Date depart' aria-describedby='saisie-date-depart'>
                        </div>
                        <div class='input-group mb-3'>
                          <select name='id_ville_depart' class='form-select' aria-label='Default select example'>
                            <option selected>Sélectionner une ville de départ</option>
                            ";
                            $query = 'SELECT id_ville, nom FROM villes ORDER BY nom;';
                            $result = pg_query($db_handle, $query);
                            while ($row = pg_fetch_array($result)) {
                              echo "<option value=$row[0]>$row[1]</option>";
                            }
                            echo "
                          </select>
                        </div>
                        &nbsp;

                        <div class='input-group mb-3'>
                          Étape d'arrivée
                        </div>
                        <div class='input-group mb-3'>
                          <input name='date_arrivee' type='datetime-local' class='form-control' placeholder='Date d'arrivée*''
                            aria-label='Date arrivee' aria-describedby='saisie-date-arrivee'>
                        </div>
                        <div class='input-group mb-3'>
                          <select name='id_ville_arrivee' class='form-select' aria-label='Default select example'>
                            <option selected>Sélectionner une ville de d'arrivée'</option>
                            ";
                            $query = 'SELECT id_ville, nom FROM villes ORDER BY nom;';
                            $result = pg_query($db_handle, $query);
                            while ($row = pg_fetch_array($result)) {
                              echo "<option value=$row[0]>$row[1]</option>";
                            }
                          echo "
                          </select>
                        </div>

                        <div class='input-group mb-3'>
                          <input name='mot_de_passe' type='password' class='form-control' placeholder='Mot de Passe*'
                            aria-label='Mot de Passe' aria-describedby='saisie-mot-de-passe'>
                        </div>
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fermer</button>
                        <button type='submit' class='btn btn btn-dark'>Envoyer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>";
            }
          }


          ?>
          <!-- </tbody> -->
        </table>
      </div>
      <!-- <div class="col-1"></div> -->
    </div>
  </div>
</body>

</html>