<?php
    $table = "$_POST[table]";
    
    $params = parse_ini_file('../../database.ini');
    $dbconn = pg_connect("host=".$params['host']." port=".$params['port']." password=".$params['password']);

    if ($table === "etudiants") {
        $date = date('Y-m-d H:i:s', strtotime("$_POST[date_de_naissance]"));
        $query = "INSERT INTO etudiants (nom, prenom, mail, mot_de_passe, date_de_naissance) VALUES ('$_POST[nom]', '$_POST[prenom]', '$_POST[mail]', '$_POST[mot_de_passe]', '$date');";
    }
    elseif ($table === "voitures") {
        $query = "INSERT INTO voitures (marque, modele, typ, couleur, etat, divers, id_etudiant) VALUES ('$_POST[marque]', '$_POST[modele]', '$_POST[typ]', '$_POST[couleur]', '$_POST[etat]', '$_POST[divers]', (SELECT id_etudiant FROM etudiants WHERE nom = '$_POST[nom]' AND prenom = '$_POST[prenom]'));";
    }
    elseif ($table === "villes") {
        $query = "INSERT INTO villes (nom) VALUES ('$_POST[nom]');";
    }
    
    $res = pg_query($dbconn, $query);

    function function_alert($msg) {
        echo "<script type='text/javascript'>alert('$msg')
        window.location.replace('../index.php');</script>";
    }


    if ($res) {
        function_alert("POST data is successfully logged");
    }
    else {
        function_alert("User must have sent wrong inputs");
    }
?>