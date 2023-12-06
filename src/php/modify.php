<?php
$table = "$_POST[table]";

$params = parse_ini_file('../../database.ini');
$dbconn = pg_connect("host=" . $params['host'] . " port=" . $params['port'] . " password=" . $params['password']);

if ($table === "etudiants") {
    $query = "SELECT COUNT(id_etudiant) FROM etudiants WHERE id_etudiant = $_POST[id_etudiant] AND mot_de_passe = '$_POST[mot_de_passe]';";
    $res = pg_query($dbconn, $query);
    $count = pg_fetch_row($res);
    if ($count[0] > 0) {
        $query = "UPDATE etudiants SET mail = '$_POST[mail]', date_de_naissance = '$_POST[date_de_naissance]' WHERE id_etudiant = '$_POST[id_etudiant]' and mot_de_passe = '$_POST[mot_de_passe]';";
    } else {
        function_alert("Mauvais mot de passe");
    }
} elseif ($table === "voitures") {
    $query = "SELECT COUNT(*) FROM etudiants WHERE id_etudiant = $_POST[id_etudiant] AND mot_de_passe = '$_POST[mot_de_passe]';";
    $res = pg_query($dbconn, $query);
    $count = pg_fetch_row($res);
    if ($count[0] > 0) {
        $query = "UPDATE voitures SET marque = '$_POST[marque]', modele = '$_POST[modele]', typ = '$_POST[typ]', couleur = '$_POST[couleur]', etat = '$_POST[etat]', divers = '$_POST[divers]' WHERE id_etudiant = '$_POST[id_etudiant]';";
    } else {
        function_alert("Mauvais mot de passe");
    }
} elseif ($table === "mot_de_passe") {
    $query = "SELECT COUNT(id_etudiant) FROM etudiants WHERE id_etudiant = $_POST[id_etudiant] AND mot_de_passe = '$_POST[ancien_mot_de_passe]';";
    $res = pg_query($dbconn, $query);
    $count = pg_fetch_row($res);
    if ($count[0] > 0) {
        if (strcmp($_POST['nouveau_mot_de_passe_1'], $_POST['nouveau_mot_de_passe_2'])) {
            function_alert("Les deux mots de passes sont différents");
        } else {
            $query = "UPDATE etudiants SET mot_de_passe = '$_POST[nouveau_mot_de_passe_1]' WHERE id_etudiant = $_POST[id_etudiant] AND mot_de_passe = '$_POST[ancien_mot_de_passe]';";
        }
    } else {
        function_alert("Mauvais mot de passe");
    }
}


$res = pg_query($dbconn, $query);

function function_alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg')
        window.location.replace('../index.php');</script>";
}


if ($res) {
    function_alert("Les données ont été modifiées avec succès");
} else {
    function_alert("Vous avez dû rentrer de mauvaises informations");
}
?>