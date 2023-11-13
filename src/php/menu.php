<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <!-- <a class="navbar-brand" href="#">Données</a> -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <?php
          $beg_href = "";
          $current_page = basename($_SERVER['PHP_SELF']);
          if ($current_page == "index.php") {
            $beg_href = "php/";
          }
          ?>
          <li class="nav-item">
            <?php
            if (basename($_SERVER['PHP_SELF']) == "index.php") {
              echo "<a class=\"nav-link active\" aria-current=\"page\" href=\"\">Accueil</a>";
            } else {
              echo "<a class=\"nav-link\" href=\"http://localhost:8000/index.php\">Accueil</a>";
            }
            ?>
          </li>
          <li class="nav-item">
            <?php
            if (basename($_SERVER['PHP_SELF']) == "conducteurs.php") {
              echo "<a class=\"nav-link active\" aria-current=\"page\" href=\"\">Conducteurs</a>";
            } else {
              echo "<a class=\"nav-link\" href=\"" . $beg_href . "conducteurs.php\">Conducteurs</a>";
            }
            ?>
          </li>
          <li class="nav-item">
            <?php
            if (basename($_SERVER['PHP_SELF']) == "passagers.php") {
              echo "<a class=\"nav-link active\" aria-current=\"page\" href=\"\">Passagers</a>";
            } else {
              echo "<a class=\"nav-link\" href=\"" . $beg_href . "passagers.php\">Passagers</a>";
            }
            ?>
          </li>
          <li class="nav-item">
            <?php
            if (basename($_SERVER['PHP_SELF']) == "vehicules.php") {
              echo "<a class=\"nav-link active\" aria-current=\"page\" href=\"\">Véhicules</a>";
            } else {
              echo "<a class=\"nav-link\" href=\"" . $beg_href . "vehicules.php\">Véhicules</a>";
            }
            ?>
          </li>
          <li class="nav-item">
            <?php
            if (basename($_SERVER['PHP_SELF']) == "trajets.php") {
              echo "<a class=\"nav-link active\" aria-current=\"page\" href=\"\">Trajet</a>";
            } else {
              echo "<a class=\"nav-link\" href=\"" . $beg_href . "trajets.php\">Trajet</a>";
            }
            ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>