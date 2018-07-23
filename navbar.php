<?php
          # start session in all pages!!!!!!!!!!
          if (isset($_SESSION["id_login"])) {
          $login=$_SESSION["id_login"];
          $con=mysqli_connect("localhost","root","");
          mysqli_select_db($con,'aumk');
          $reponse = mysqli_query($con,"select ID_PROFILE from utilisateurs where ID_LOGIN=$login");
          $profile = mysqli_fetch_array($reponse);
        }?>
<link href="css/navbar.css" rel="stylesheet">
<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
    <a class="navbar-brand" href="Home_page.php"><img height="30x" src="res/images/home.svg"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" id="dropdown01" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catégorie 1</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <?php
               if ($profile[0] == 1||$profile[0] == 3){?>
               <a class="dropdown-item" href="ajoutement_categorie1.php">Ajouter une Catégorie</a>
               <?php
               }
               ?>
              <a class="dropdown-item" href="Rechercher_categorie1.php">Rechercher une Catégorie</a>
            </div>
          </li>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" id="dropdown02" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catégorie 2</a>
          <div class="dropdown-menu" aria-labelledby="dropdown02">
          <?php
           if ($profile[0] == 1||$profile[0] == 3){?>
            <a class="dropdown-item" href="ajoutement_categorie2.php">Ajouter une Catégorie</a>
            <?php
            }
            ?>
            <a class="dropdown-item" href="Rechercher_categorie2.php">Rechercher une Catégorie</a>
          </div>
        </li>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" id="dropdown03" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Article</a>
          <div class="dropdown-menu" aria-labelledby="dropdown03">
          <?php if ($profile[0] == 1||$profile[0] == 3){?>
            <a class="dropdown-item" href="ajoutement_articles.php">Ajouter un article</a>
            <?php
          }
          ?>
            <a class="dropdown-item" href="Rechercher_articles.php">Rechercher un article</a>
          </div>
        </li>
        <?php
         if ($profile[0] == 1||$profile[0] == 3){?>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">achat fournisseur</a>
          <div class="dropdown-menu" aria-labelledby="dropdown04">
          <a class="dropdown-item" href="effectue_achat.php">effectue un achat</a>
            <a class="dropdown-item" href="consultation_achats.php">consultation des achats</a>
          </div>
        </li>
        <?php
      }
      ?>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Réception</a>
          <div class="dropdown-menu" aria-labelledby="dropdown04">
            <a class="dropdown-item" href="prendre_produit.php">Prendre un produit</a>
            <a class="dropdown-item" href="consultation_collectibles.php">consultation des collectibles</a>
          </div>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" method="GET" action="search.php">
        <input required class="form-control mr-sm-2" name="search" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>