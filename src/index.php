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
  <?php
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
  ?>
  <center>
    <h1>
      Accueil
    </h1>
  </center>
  <?php
  include "php/menu.php";
  ?>
</body>

</html>