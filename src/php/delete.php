<?php
$page = "$_POST[page]";
$table = "$_POST[table]";

$params = parse_ini_file('../../database.ini');
$dbconn = pg_connect("host=" . $params['host'] . " port=" . $params['port'] . " password=" . $params['password']);

if ($table === "etudiants") {
    $query = "DELETE FROM etudiants WHERE id_etudiant = '$_POST[id_etudiant]' AND mot_de_passe = '$_POST[mot_de_passe]';";
} elseif ($table === "voitures") {
    $query = "SELECT COUNT(*) FROM etudiants WHERE nom = '$_POST[nom]' AND prenom = '$_POST[prenom]' AND mot_de_passe = '$_POST[mot_de_passe]'";
    $res = pg_query($dbconn, $query);
    $conducteur = pg_fetch_row($res);
    if ($conducteur > 0) {
        $query = "DELETE FROM voitures WHERE id_voiture = '$_POST[id_voiture]';"; // and mot_de_passe = '$_POST[mot_de_passe]';"
    } else {
        function_alert("Wrong password", $page);
    }
} elseif ($table === "villes") {
    $query = "DELETE FROM villes WHERE id_ville = '$_POST[id_ville]';";
}

$res = pg_query($dbconn, $query);

function function_alert($msg, $page)
{
    echo "<script type='text/javascript'>alert('$msg')
        window.location.replace('$page.php');</script>";
}


if ($res) {
    function_alert("Data are successfully deleted", $page);
} else {
    function_alert("User must have sent wrong inputs", $page);
}
?>