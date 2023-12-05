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

  <h1 class="text-lg-center">Accueil</h1>
  <?php
  include "php/menu.php";

  $params = parse_ini_file('../database.ini');
  $db_handle = pg_connect("host=" . $params['host'] . " port=" . $params['port'] . " password=" . $params['password']);

  ?>

  <div class="container-fluid border">
    <div class="row">
      <div class="col-sm-3 align-self-start">
        <form method="get">
          <select class="form-select" id="selection" onchange="changerAffichageAjout()">
            <option value="ajout_etudiant" selected>Ajouter un étudiant</option>
            <option value="ajout_voiture">Ajouter une voiture</option>
            <option value="ajout_ville">Ajouter une ville</option>
            <option value="modification_etudiant">Modifier un étudiant</option>
            <option value="modification_voiture">Modifier une voiture</option>
            <option value="modification_mot_de_passe">Modifier un mot de passe</option>
          </select>
        </form>
      </div>
    </div>

    <!-- Formulaires d'ajouts -->
    <div class="row justify-content-center"> <!-- les div avec des colonnes sectionnent la page en lignes -->
      <div class="col"></div> <!-- les div avec des colonnes sectionnent la page en colonnes -->
      <div class="col-sm-3"> <!-- prend la place de 3 petites colonnes -->

        <!-- form ajout etudiant -->
        <form id="form-ajout-etudiant" action="php/insert.php" method="post">
          <input type='hidden' name='table' value='etudiants'>
          <!-- un div = un conteneur d'objets html : servent juste à positionner les éléments -->

          <div class="input-group mb-3">
            <input name="nom" type="text" class="form-control" placeholder="Nom*" aria-label="Nom"
              aria-describedby="saisie-nom">
            <input name="prenom" type="text" class="form-control" placeholder="Prénom*" aria-label="Prénom"
              aria-describedby="saisie-prenom">
          </div>

          <div class="input-group mb-3">
            <!-- champ de saisie d'email -->
            <input name="mail" type="email" class="form-control" placeholder="Addresse mail*" aria-label="Adresse mail"
              aria-describedby="saisie-email">
          </div>

          <div class="input-group mb-3">
            <input name="date_de_naissance" type="date" class="form-control" placeholder="Date de naissance"
              aria-label="Date de naissance" aria-describedby="saisie-date-de-naissance">
          </div>

          <div class="input-group mb-3">
            <input name="mot_de_passe" type="password" class="form-control" placeholder="Mot de Passe*"
              aria-label="Mot de Passe" aria-describedby="saisie-mot-de-passe">
          </div>

          <div class="input-group mb-3">
            <button type="input" class="btn btn btn-dark">Envoyer</button>
          </div>
        </form>


        <!-- form ajout voiture -->
        <form id="form-ajout-voiture" class="d-none" action="php/insert.php" method="post">
          <input type='hidden' name='table' value='voitures'>

          <div class="input-group mb-3">
            <select name="id_etudiant" class="form-select" aria-label="Default select example">
              <option selected>Sélectionner un étudiant</option>
              <?php
              $query = "SELECT * FROM etudiants LEFT OUTER JOIN voitures ON etudiants.id_etudiant = voitures.id_etudiant WHERE id_voiture is null ORDER BY nom;";
              $result = pg_query($db_handle, $query);
              while ($row = pg_fetch_array($result)) {
                echo "<option value='$row[0]'>$row[1] $row[2]</option>";
              }
              ?>
            </select>
          </div>

          <div class="input-group mb-3">
            <input name="marque" type="text" class="form-control" placeholder="Marque*" aria-label="Marque"
              aria-describedby="saisie-marque">
          </div>

          <div class="input-group mb-3">
            <input name="modele" type="text" class="form-control" placeholder="Modèle*" aria-label="Modele"
              aria-describedby="saisie-modele">
            <input name="type" type="text" class="form-control" placeholder="Type" aria-label="Type"
              aria-describedby="saisie-type">
            <input name="couleur" type="text" class="form-control" placeholder="Couleur" aria-label="Couleur"
              aria-describedby="saisie-couleur">
          </div>

          <div class="input-group mb-3">
            <input name="etat" type="text" class="form-control" placeholder="État" aria-label="Etat"
              aria-describedby="saisie-etat">
            <input name="divers" type="text" class="form-control" placeholder="Divers" aria-label="Divers"
              aria-describedby="saisie-divers">
          </div>

          <div class="input-group mb-3">
            <input name="mot_de_passe" type="password" class="form-control" placeholder="Mot de Passe*"
              aria-label="Mot de Passe" aria-describedby="saisie-mot-de-passe">
          </div>

          <div class="input-group mb-3">
            <button type="input" class="btn btn btn-dark">Envoyer</button>
          </div>
        </form>

        <!-- form ajout ville -->
        <form id="form-ajout-ville" class="d-none" action="php/insert.php" method="post">
          <input type='hidden' name='table' value='villes'>

          <div class="input-group mb-3">
            <input name="nom" type="text" class="form-control" placeholder="Nom*" aria-label="Nom"
              aria-describedby="saisie-nom">
          </div>

          <div class="input-group mb-3">
            <button type="input" class="btn btn btn-dark">Envoyer</button>
          </div>
        </form>

        <!-- form modification etudiant -->
        <form id="form-modification-etudiant" class="d-none" action="php/modify.php" method="post">
          <input type='hidden' name='table' value='etudiants'>

          <div class="input-group mb-3">
            <select name="id_etudiant" class="form-select" aria-label="Default select example">
              <option selected>Sélectionner un étudiant</option>
              <?php
              $query = "SELECT id_etudiant, nom, prenom FROM etudiants ORDER BY nom;";
              $result = pg_query($db_handle, $query);
              while ($row = pg_fetch_array($result)) {
                echo "<option value='$row[0]'>$row[1] $row[2]</option>";
              }
              ?>
            </select>
          </div>

          <div class="input-group mb-3">
            <input name="mail" type="email" class="form-control" placeholder="Addresse mail*" aria-label="Adresse mail"
              aria-describedby="saisie-email">
          </div>

          <div class="input-group mb-3">
            <input name="date_de_naissance" type="date" class="form-control" placeholder="Date de naissance"
              aria-label="Date de naissance" aria-describedby="saisie-date-de-naissance">
          </div>

          <div class="input-group mb-3">
            <input name="mot_de_passe" type="password" class="form-control" placeholder="Mot de Passe*"
              aria-label="Mot de Passe" aria-describedby="saisie-mot-de-passe">
          </div>

          <div class="input-group mb-3">
            <button type="input" class="btn btn btn-dark">Envoyer</button>
          </div>
        </form>


        <!-- form modification voiture -->
        <form id="form-modification-voiture" class="d-none" action="php/modify.php" method="post">
          <input type='hidden' name='table' value='voitures'>

          <div class="input-group mb-3">
            <select name="id_etudiant" class="form-select" aria-label="Default select example">
              <option selected>Sélectionner un conducteur</option>
              <?php
              $query = "SELECT etudiants.id_etudiant, nom, prenom FROM etudiants JOIN voitures ON etudiants.id_etudiant = voitures.id_etudiant ORDER BY nom;";
              $result = pg_query($db_handle, $query);
              while ($row = pg_fetch_array($result)) {
                echo "<option value='$row[0]'>$row[1] $row[2]</option>";
              }
              ?>
            </select>
          </div>

          <div class="input-group mb-3">
            <input name="marque" type="text" class="form-control" placeholder="Marque*" aria-label="Marque"
              aria-describedby="saisie-marque">
          </div>

          <div class="input-group mb-3">
            <input name="modele" type="text" class="form-control" placeholder="Modèle*" aria-label="Modele"
              aria-describedby="saisie-modele">
            <input name="type" type="text" class="form-control" placeholder="Type" aria-label="Type"
              aria-describedby="saisie-type">
            <input name="couleur" type="text" class="form-control" placeholder="Couleur" aria-label="Couleur"
              aria-describedby="saisie-couleur">
          </div>

          <div class="input-group mb-3">
            <input name="etat" type="text" class="form-control" placeholder="État" aria-label="Etat"
              aria-describedby="saisie-etat">
            <input name="divers" type="text" class="form-control" placeholder="Divers" aria-label="Divers"
              aria-describedby="saisie-divers">
          </div>

          <div class="input-group mb-3">
            <input name="mot_de_passe" type="password" class="form-control" placeholder="Mot de Passe*"
              aria-label="Mot de Passe" aria-describedby="saisie-mot-de-passe">
          </div>

          <div class="input-group mb-3">
            <button type="input" class="btn btn btn-dark">Envoyer</button>
          </div>
        </form>


        <!-- form modification mot de passe -->
        <form id="form-modification-mot-de-passe" class="d-none" action="php/modify.php" method="post">
          <input type='hidden' name='table' value='mot_de_passe'>

          <div class="input-group mb-3">
            <select name="id_etudiant" class="form-select" aria-label="Default select example">
              <option selected>Sélectionner un étudiant</option>
              <?php
              $query = "SELECT id_etudiant, nom, prenom FROM etudiants ORDER BY nom;";
              $result = pg_query($db_handle, $query);
              while ($row = pg_fetch_array($result)) {
                echo "<option value='$row[0]'>$row[1] $row[2]</option>";
              }
              ?>
            </select>
          </div>

          <div class="input-group mb-3">
            <input name="ancien_mot_de_passe" type="password" class="form-control" placeholder="Ancien mot de passe*" aria-label="Adresse mail">
          </div>

          <div class="input-group mb-3">
            <input name="nouveau_mot_de_passe_1" type="password" class="form-control" placeholder="Nouveau mot de passe*" aria-label="Nouveau mot de passe">
          </div>

          <div class="input-group mb-3">
            <input name="nouveau_mot_de_passe_2" type="password" class="form-control" placeholder="Répéter nouveau mot de passe*" aria-label="Répéter nouveau mot de passe">
          </div>

          <div class="input-group mb-3">
            <button type="input" class="btn btn btn-dark">Envoyer</button>
          </div>
        </form>


      </div>
      <div class="col"></div>
    </div>
  </div>
  <script src="js/index.js"></script>
</body>

</html>