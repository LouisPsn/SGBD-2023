<?php
$table = "$_POST[table]";

$params = parse_ini_file('../../database.ini');
$dbconn = pg_connect("host=" . $params['host'] . " port=" . $params['port'] . " password=" . $params['password']);

if ($table === "etudiants") {
    $date = date('Y-m-d H:i:s', strtotime("$_POST[date_de_naissance]"));
    $query = "INSERT INTO etudiants (nom, prenom, mail, mot_de_passe, date_de_naissance) VALUES ('$_POST[nom]', '$_POST[prenom]', '$_POST[mail]', '$_POST[mot_de_passe]', '$date');";
} elseif ($table === "voitures") {
    $query = "SELECT COUNT(*) FROM etudiants WHERE id_etudiant = $_POST[id_etudiant] AND mot_de_passe = '$_POST[mot_de_passe]';";
    $res = pg_query($dbconn, $query);
    $count = pg_fetch_row($res);
    if ($count[0] > 0) {
        function_alert("Mauvais mot de passe");
    } else {
        $query = "INSERT INTO voitures (marque, modele, typ, couleur, etat, divers, id_etudiant) VALUES ('$_POST[marque]', '$_POST[modele]', '$_POST[typ]', '$_POST[couleur]', '$_POST[etat]', '$_POST[divers]', $_POST[id_etudiant]);";
    }
} elseif ($table === "villes") {
    $query = "INSERT INTO villes (nom) VALUES ('$_POST[nom]');";
} elseif ($table === "voyages") {
    $query = "SELECT COUNT(*) FROM etudiants WHERE id_etudiant = $_POST[id_etudiant] AND mot_de_passe = '$_POST[mot_de_passe]';";
    $res = pg_query($dbconn, $query);
    $count = pg_fetch_row($res);
    if ($count[0] == 0) {
        function_alert("Mauvais mot de passe");
    } else {
        $query = "SELECT id_voiture FROM voitures JOIN etudiants ON etudiants.id_etudiant = voitures.id_etudiant WHERE etudiants.id_etudiant = $_POST[id_etudiant];";
        $result = pg_query($dbconn, $query);
        $result = pg_fetch_array($result);
        $id_voiture = $result[0];

        $date_depart = date('Y-m-d H:i:s', strtotime("$_POST[date_depart]"));
        $query = "INSERT INTO etapes (date, id_ville) VALUES ('$date_depart', $_POST[id_ville_depart]);";
        $result = pg_query($dbconn, $query);

        $date_arrivee = date('Y-m-d H:i:s', strtotime("$_POST[date_arrivee]"));
        $query = "INSERT INTO etapes (date, id_ville) VALUES ('$date_arrivee', $_POST[id_ville_arrivee]);";
        $result = pg_query($dbconn, $query);

        $query = "SELECT id_etape FROM etapes WHERE date = '$date_depart' AND id_ville = $_POST[id_ville_depart];";
        $result = pg_query($dbconn, $query);
        $result = pg_fetch_array($result);
        $etape_depart_voyage = $result[0];

        $query = "SELECT id_etape FROM etapes WHERE date = '$date_arrivee' AND id_ville = $_POST[id_ville_arrivee];";
        $result = pg_query($dbconn, $query);
        $result = pg_fetch_array($result);
        $etape_depart_voyage = $result[0];

        $query = "INSERT INTO voyages (nombre_places, id_voiture, distance, etape_depart_voyage, etape_arrive_voyage) VALUES ($_POST[nombre_de_place], $id_voiture, $_POST[distance], $etape_depart_voyage, $etape_depart_voyage);";
    }
}

$res = pg_query($dbconn, $query);

function function_alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg')
        window.location.replace('../index.php');</script>";
}


if ($res) {
    function_alert("Les données ont été ajoutées avec succès");
} else {
    function_alert("Vous avez dû rentrer de mauvaises informations");
}
?>