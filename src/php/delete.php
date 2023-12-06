<?php
$page = "$_POST[page]";
$table = "$_POST[table]";

$params = parse_ini_file('../../database.ini');
$dbconn = pg_connect("host=" . $params['host'] . " port=" . $params['port'] . " password=" . $params['password']);

if ($table === "etudiants") {
    $query = "SELECT COUNT(*) FROM etudiants WHERE id_etudiant = $_POST[id_etudiant] AND mot_de_passe = '$_POST[mot_de_passe]'";
    $res = pg_query($dbconn, $query);
    $res = pg_fetch_array($res);
    if ($res > 0) {
        $query = "DELETE FROM etudiants WHERE id_etudiant = $_POST[id_etudiant] AND mot_de_passe = '$_POST[mot_de_passe]';";
    } else {
        function_alert("Mauvais mot de passe", $page);
    }
} elseif ($table === "voitures") {
    $query = "SELECT COUNT(*) FROM etudiants WHERE id_etudiant = $_POST[id_etudiant] AND mot_de_passe = '$_POST[mot_de_passe]'";
    $res = pg_query($dbconn, $query);
    $conducteur = pg_fetch_row($res);
    if ($conducteur > 0) {
        $query = "DELETE FROM voitures WHERE id_voiture = '$_POST[id_voiture]';";
    } else {
        function_alert("Mauvais mot de passe", $page);
    }
} elseif ($table === "villes") {
    $query = "DELETE FROM villes WHERE id_ville = '$_POST[id_ville]';";
}
elseif ($table === "voyages") {
    $query = "SELECT COUNT(*) FROM etudiants WHERE id_etudiant = $_POST[id_etudiant] AND mot_de_passe = '$_POST[mot_de_passe]'";
    $res = pg_query($dbconn, $query);
    $trajets = pg_fetch_row($res);
    if ($trajets > 0) {
        $query = "DELETE FROM voyages WHERE id_voyage = $_POST[id_voyage];";
    } else {
        function_alert("Mauvais mot de passe", $page);
    }
} elseif ($table === "reservations") {
    $query = "SELECT COUNT(*) FROM etudiants WHERE id_etudiant = $_POST[id_etudiant] AND mot_de_passe = '$_POST[mot_de_passe]'";
    $res = pg_query($dbconn, $query);
    $trajets = pg_fetch_row($res);
    if ($trajets > 0) {
        $query = "ALTER TABLE reservations nocheck constraint all;
        DELETE FROM reservations WHERE id_reservation = $_POST[id_reservation];
        ALTER TABLE reservations check constraint all;";
    } else {
        function_alert("Mauvais mot de passe", $page);
    }
}

$res = pg_query($dbconn, $query);

function function_alert($msg, $page)
{
    echo "<script type='text/javascript'>alert('$msg')
        window.location.replace('$page.php');</script>";
}


if ($res) {
    function_alert("Les données ont été supprimées avec succès", $page);
} else {
    function_alert("Vous avez dû rentrer de mauvaises informations", $page);
}
?>