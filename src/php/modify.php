<?php
    $table = "$_POST[table]";
    
    $params = parse_ini_file('../../database.ini');
    $dbconn = pg_connect("host=".$params['host']." port=".$params['port']." password=".$params['password']);

    if ($table === "etudiants") {
        $query = "SELECT COUNT(*) FROM etudiants WHERE id_etudiant = $_POST[id_etudiant] AND mot_de_passe = '$_POST[mot_de_passe]';";
        $result = pg_query($dbconn, $query);
        if ($result === 0) {
            function_alert("Mauvais mot de passe");
        }
        $query = "UPDATE etudiants SET mail = '$_POST[mail]', date_de_naissance = '$_POST[date_de_naissance]' WHERE id_etudiant = $_POST[id_etudiant] and mot_de_passe = '$_POST[mot_de_passe]';";
    }
    elseif ($table === "voitures") {
        $query = "SELECT COUNT(*) FROM etudiants WHERE id_etudiant = $_POST[id_etudiant] AND mot_de_passe = '$_POST[mot_de_passe]';";
        $result = pg_query($dbconn, $query);
        if ($result === 0) {
            function_alert("Mauvais mot de passe");
        }
        $query = "UPDATE voitures SET marque = '$_POST[marque]', modele = '$_POST[modele]', typ = '$_POST[typ]', couleur = '$_POST[couleur]', etat = '$_POST[etat]', divers = '$_POST[divers]' WHERE id_etudiant = '$_POST[id_etudiant]';";
    }
    elseif ($table === "villes") {
        $query = "UPDATE villes SET date_avis = '$_POST[date]', note = $_POST[note], commentaire = $_POST[commentaire]', nb_joueurs = $_POST[nb_joueurs], id_joueur = (SELECT id_joueur FROM joueurs WHERE pseudo = '$_POST[pseudo]'), id_jeu = (SELECT id_jeu FROM jeux WHERE nom_jeu = '$_POST[nom_jeu]') WHERE id_avis = '$_POST[id]';"; 
    }
    
    $res = pg_query($dbconn, $query);

    function function_alert($msg) {
        echo "<script type='text/javascript'>alert('$msg')
        window.location.replace('../index.php');</script>";
    }


    if ($res) {
        function_alert("Les données ont été modifiées avec succès");
    }
    else {
        function_alert("Vous avez dû rentrer de mauvaises informations");
    }
?>