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
  $sql_voyages = "SELECT * FROM voyages ;";
  $result_voyages = pg_query($db_handle, $sql_voyages);
  ?>


  <div class="container">
    <div class="row justify-content-center">

      <!-- <div class="col-1"></div> -->
      <div class="col">
        <table class="table table-hover table-responsive" id="table_conducteurs">
          <thead>
            <tr>
              <th scope="col">ID Voyage</th>
              <th scope="col">Conducteur</th>
              <th scope="col">Voiture</th>
              <th scope="col">Lieu et Date de Départ</th>
              <th scope="col">Lieu et Date d'Arrivée</th>
              <!-- <th scope="col">Avis</th> -->
              <th scope="col">
                <center>Suppression</center>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php

function function_alert($msg) {
  echo "<script type='text/javascript'>alert('$msg')
  window.location.replace('./trajets.php');</script>";
}

            while ($row_voyage = pg_fetch_array($result_voyages)) {
              
              // echo "<tr>";
              // echo "<th scope=\"row\">" . $row_voyage[0] . "</th>";
              // for ($i=1; $i < 26; $i++) { 
              //   # code...
              //   echo "<td>" . $row_voyage[$i] . "</td>";
              // }
              // echo "</tr>";
              // echo "<tr>";

              
              $query_resa_du_voyage = "SELECT id_reservation, prenom, etape_depart_resa, etape_arrive_resa, confirmation_reservation FROM reservations
              -- JOIN etudiants ON etudiants.id_etudiant = reservations.id_voyage
              JOIN etudiants ON reservation.id_etudiant = etudiants.id_etudiant
              JOIN voyages ON voyages.id_voyage = reservations.id_voyage
              JOIN voitures ON voitures.id_voiture = voyages.id_voiture
              WHERE voyages.id_voyage = $row_voyage[0];";
              $res_resa_du_voyage = pg_query($db_handle, $query_resa_du_voyage);
              while ($row_resa = pg_fetch_array($res_resa_du_voyage)){

                // function_alert($row[1]);
                echo "<tr>";
                
                // echo "<th scope=\"row\">" . $row_resa[0] . "</th>";
                // echo "<td>" . $row_resa[10] . "</td>";
                // echo "<td>" . $row_resa[5] . "</td>";
                // echo "<td>" . $row_resa[6] . "</td>";
                // echo "<td>" . $row_resa[2] . "</td>";

                for ($i=1; $i < 10; $i++) { 
                  # code...
                  echo "<td>" . $row_resa[$i] . "</td>";
                }
                echo "</tr>";
              }
              // echo "<td>" . $row[2] . "</td>";
              // echo "<td>" . $row[3] . "</td>";
              // echo "<td>" . $row[5] . "</td>";
              // $note = pg_fetch_row($avis);
              // echo "<td>" . number_format($note[0], 2) . "</td>";
              
              // echo "
              // <form id='form-suppresion-etudiant' class='d-none' action='delete.php' method='post'>  
              //   <input type='hidden' name='page' value='conducteurs'>
              //   <input type='hidden' name='table' value='etudiants'>
              //   <input type='hidden' name='id_etudiant' value='$row[0]'>
              
              //   <!-- Button trigger modal -->
              //   <td>
              //   <center>
              //   <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#passwordModal'>
              //     X
              //   </button>
              //   </center>
              //   </td>
              
              //   <!-- Modal -->
              //   <div class='modal fade' id='passwordModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
              //     <div class='modal-dialog'>
              //       <div class='modal-content'>
              //         <div class='modal-header'>
              //           <h5 class='modal-title' id='exampleModalLabel'>Mot de Passe</h5>
              //           <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
              //         </div>
              //         <div class='modal-body'>
              //         <div class='input-group mb-3'>
              //           <input name='mot_de_passe' type='password' class='form-control' placeholder='Mot de Passe*'
              //             aria-label='Mot de Passe' aria-describedby='saisie-mot-de-passe'>
              //           </div>
              //         </div>
              //         <div class='modal-footer'>
              //           <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fermer</button>
              //           <button type='submit' class='btn btn-danger'>Envoyer</button>
              //         </div>
              //       </div>
              //     </div>
              //   </div>
              // </form>";
              // echo "</tr>";
              // echo "<tr> </tr>";
            }
            echo " ";
            ?>
          </tbody>
        </table>
      </div>
      <!-- <div class="col-1"></div> -->
    </div>
  </div>
  <script src="../js/index.js"></script>
</body>

</html>