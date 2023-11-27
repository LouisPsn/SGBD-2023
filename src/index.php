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
  ?>

  <div class="container-fluid border">
    <div class="row">
      <div class="col-sm-3 align-self-start">
        <form method="get">
          <select class="form-select" id="selection" onchange="changerAffichageAjout()">
            <option value="ajout_etudiant" selected>Ajouter un étudiant</option>
            <option value="ajout_voiture">Ajouter une voiture</option>
            <option value="ajout_ville">Ajouter une ville</option>
          </select>
        </form>
      </div>
    </div>

    <!-- Formulaires d'ajouts -->
    <div class="row justify-content-center"> <!-- les div avec des colonnes sectionnent la page en lignes -->
      <div class="col"></div> <!-- les div avec des colonnes sectionnent la page en colonnes -->
      <div class="col-sm-3"> <!-- prend la place de 3 petites colonnes -->
        <!-- form ajout joueur -->
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
            <!-- champ de saisie d'email -->
            <input name="mot_de_passe" type="password" class="form-control" placeholder="Mot de Passe*"
              aria-label="Mot de Passe" aria-describedby="saisie-mot-de-passe">
          </div>

          <button type="input" class="btn btn-outline-secondary">Envoyer</button>
        </form>


        <!-- form ajout jeu -->
        <form id="form-ajout-voiture" class="d-none" action="php/insert.php" method="post">
          <input type='hidden' name='table' value='voitures'>
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
            <input name="nom" type="text" class="form-control" placeholder="Nom*" aria-label="Nom"
              aria-describedby="saisie-nom">
            <input name="prenom" type="text" class="form-control" placeholder="Prenom*" aria-label="Prenom"
              aria-describedby="saisie-prenom">
          </div>

          <button type="input" class="btn btn-outline-secondary">Envoyer</button>
        </form>

        <!-- form ajout avis -->
        <form id="form-ajout-ville" class="d-none" action="php/insert.php" method="post">
          <input type='hidden' name='table' value='avis'>
          <div class="input-group mb-3">
            <input name="pseudo" type="text" class="form-control" placeholder="Pseudo*" aria-label="Pseudo"
              aria-describedby="saisie-pseudo">
          </div>

          <div class="input-group mb-3">
            <input name="mail" type="text" class="form-control" placeholder="Addresse mail*" aria-label="Adresse mail"
              aria-describedby="saisie-email">
          </div>

          <div class="input-group mb-3">
            <input name="date" type="date" class="form-control" id="date">
          </div>

          <div class="input-group mb-3">
            <input name="nom_jeu" type="text" class="form-control" placeholder="Jeu*" aria-label="Jeu"
              aria-describedby="saisie-jeu">
          </div>

          <div class="input-group mb-3">
            <input name="note" type="text" class="form-control" placeholder="Note*" aria-label="note"
              aria-describedby="saisie-note">
            <input name="nb_joueurs" type="text" class="form-control" placeholder="Nb_joueurs*"
              aria-label="Nombre de joueurs" aria-describedby="saisie-nb_joueurs">
          </div>

          <div class="input-group mb-3">
            <input name="commentaire" type="text" class="form-control" placeholder="Commentaire*"
              aria-label="Commentaire" aria-describedby="saisie-commentaire">
          </div>

          <button type="input" class="btn btn-outline-secondary">Envoyer</button>
        </form>



        </form>
      </div>
      <div class="col"></div>
    </div>
  </div>
  <script src="js/index.js"></script>
</body>

</html>