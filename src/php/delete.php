<?php
    $table = "$_POST[table]";
    
    $params = parse_ini_file('../../database.ini');
    $dbconn = pg_connect("host=".$params['host']." port=".$params['port']." password=".$params['password']);

    if ($table === "etudiants") {
        $query = "DELETE FROM etudiants WHERE id_etudiant = '$_POST[id_etudiant]' AND mot_de_passe = '$_POST[mot_de_passe]';";
    }
    elseif ($table === "voitures") {
        $query = "DELETE FROM voitures WHERE id_voiture = '$_POST[id_voiture]';"; // and mot_de_passe = '$_POST[mot_de_passe]';"
    }
    elseif ($table === "villes") {
        $query = "DELETE FROM villes WHERE id_ville = '$_POST[id_ville]';";
    }
    
    $res = pg_query($dbconn, $query);

    function function_alert($msg) {
        echo "<script type='text/javascript'>alert('$msg')
        window.location.replace('../index.php');</script>";
    }


    if ($res) {
        function_alert("Data are successfully deleted");
    }
    else {
        function_alert("User must have sent wrong inputs");
    }
?>