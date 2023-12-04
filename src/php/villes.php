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

  <!-- <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> -->
  <script src="../js/datatables.js"></script>

  <script src="../js/index.js"></script>

  <center>
    <h1>
      Villes
    </h1>
  </center>
  <?php
  include "menu.php";

  $params = parse_ini_file('../../database.ini');

  $db_handle = pg_connect("host=" . $params['host'] . " port=" . $params['port'] . " password=" . $params['password']);

  $sql = "SELECT * FROM villes;";
  $result = pg_query($db_handle, $sql);
  ?>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col">
        <!-- class="table table-hover table-responsive" -->
        <table id="example" class="display" style="width:100%">
          <thead>
            <tr>
              <th scope="col">ID Ville</th>
              <th scope="col">Nom</th>
              <th scope="col">
                <center>Suppression</center>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($row = pg_fetch_array($result)) {
              echo "<tr>";
              echo "<th scope='row'>" . $row[0] . "</th>";
              echo "<td>" . $row[1] . "</td>";
              echo "
              <form id='form-suppresion-ville' class='d-none' action='delete.php' method='post'>
                <input type='hidden' name='page' value='villes'>
                <input type='hidden' name='table' value='villes'>
                <input type='hidden' name='id_ville' value='$row[0]'>
                <td> 
                <center>
                <button type='input' class='btn btn-danger'>X</button>
                </center>
                </td>
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