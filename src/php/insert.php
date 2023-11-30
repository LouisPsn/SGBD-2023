<?php
    $table = "$_POST[table]";
    
    $params = parse_ini_file('../../database.ini');
    $dbconn = pg_connect("host=".$params['host']." port=".$params['port']." password=".$params['password']);

    if ($table === "etudiants") {
        $date = date('Y-m-d H:i:s', strtotime("$_POST[date_de_naissance]"));
        $query = "INSERT INTO etudiants (nom, prenom, mail, mot_de_passe, date_de_naissance) VALUES ('$_POST[nom]', '$_POST[prenom]', '$_POST[mail]', '$_POST[mot_de_passe]', '$date');";
    }
    elseif ($table === "voitures") {
        $query = "SELECT COUNT(*) FROM etudiants WHERE id_etudiant = $_POST[id_etudiant] AND mot_de_passe = '$_POST[mot_de_passe]';";
        $result = pg_query($dbconn, $query);
        if ($result === 0) {
            function_alert("Mauvais mot de passe");
        }
        $query = "INSERT INTO voitures (marque, modele, typ, couleur, etat, divers, id_etudiant) VALUES ('$_POST[marque]', '$_POST[modele]', '$_POST[typ]', '$_POST[couleur]', '$_POST[etat]', '$_POST[divers]', $_POST[id_etudiant]);";
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
        function_alert("Les données ont été ajoutées avec succès");
    }
    else {
        function_alert("Vous avez dû rentrer de mauvaises informations");
    }
?>