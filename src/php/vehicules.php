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

  $host = 'localhost';
  $port = '5432';
  $database = 'louis';
  $user = 'louis';
  $password = 'louis';

  $connectString = 'host=' . $host . ' port=' . $port . ' dbname=' . $database .
    ' user=' . $user . ' password=' . $password;


  $link = pg_connect($connectString);
  if (!$link) {
    die('Error: Could not connect: ' . pg_last_error());
  }

  $query = 'select * from voitures;';

  $result = pg_query($query);

  $i = 0;
  echo '<html><body><table><tr>';
  while ($i < pg_num_fields($result)) {
    $fieldName = pg_field_name($result, $i);
    echo '<td>' . $fieldName . '</td>';
    $i = $i + 1;
  }
  echo '</tr>';
  $i = 0;

  while ($row = pg_fetch_row($result)) {
    echo '<tr>';
    $count = count($row);
    $y = 0;
    while ($y < $count) {
      $c_row = current($row);
      echo '<td>' . $c_row . '</td>';
      next($row);
      $y = $y + 1;
    }
    echo '</tr>';
    $i = $i + 1;
  }
  pg_free_result($result);

  echo '</table></body></html>';
  ?>
</body>

</html>