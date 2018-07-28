<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/signin2.css" rel="stylesheet">
    <title>Search</title>
    <style>
        .list-form {
      margin-top: 150px;
      width: 100%;
      max-width: 1000px;
      padding: 15px;
      margin-left: auto;
      margin-right: auto;
  }
    </style>
</head>
<body>
<?php
    include 'navbar.php';
    if (isset($_GET['search'])) {
      $search = $_GET['search'];
        $con=mysqli_connect("localhost","root","");
        mysqli_select_db($con,'aumk');
        $reponse = mysqli_query($con,"select * from article where NOM_ARTICLE like '%$search%'");
        $reponse2 = mysqli_query($con,"select * from categore1 where NOM_CATEGORE1 like '%$search%'");
        $reponse3 = mysqli_query($con,"select * from categore2 where NOM_CATEGORE2 like '%$search%'");
    ?>
    <div class="list-form">
    <ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center nav-item dropdown">
    Articles
    <span class="badge badge-primary badge-pill nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo mysqli_num_rows($reponse);?></span>
    <div class="dropdown-menu" aria-labelledby="dropdown01">
    <table class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom Categorie 2</th>
                        <th scope="col">Nom Article</th>
                        <?php
                        if ($profile[0] == 1||$profile[0] == 3) {?>
                            <th class="text-center" scope="col" colspan="2" width="1%">Options</th>
                            <?php
                        }
                        ?>
                    </tr>
                </thead>
                <tbody class="table-light">
            <?php while($donnees = mysqli_fetch_array($reponse)){
                $donnees1=mysqli_fetch_array(mysqli_query($con,"select NOM_CATEGORE1 from categore1 where ID_CATEGORE1 = $donnees[1]"));
                ?>
                    <tr>    
                        <th scope="row"><?php echo $donnees[0];?></th>
                        <td><?php echo $donnees1[0]; ?></td>
                        <td><?php echo $donnees[2]; ?></td>
                        <?php
                        if ($profile[0] == 1||$profile[0] == 3) {?>
                        <td><a href="ajoutement_categorie1.php?id=<?php echo $donnees[0];?>"><img src="res\images\edit-icon.svg" height="30x" title="modifier"></a></td>
                        <td><a onclick="supprimer(<?php echo $donnees[0]; ?>)" href="#"><img src="res\images\delete-icon.svg" height="30x" title="supprimer"></a></td>
                        <?php
                        }
                        ?>
                    </tr>
            <?php
            }?>
            </tbody>
            </table>
        </div>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center nav-item dropdown">
    Categorie 1
    <span class="badge badge-primary badge-pill nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo mysqli_num_rows($reponse2);?></span>
    <div class="dropdown-menu" aria-labelledby="dropdown02">
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <?php
                if ($profile[0] == 1||$profile[0] == 3) {?>
                    <th class="text-center" scope="col" colspan="2" width="1%">Options</th>
                    <?php
                }
                ?>
            </tr>
        </thead>
        <tbody class="table-light">
    <?php while($donnees = mysqli_fetch_array($reponse2)){?>
            <tr>
                <th scope="row"><?php echo $donnees[0];?></th>
                <td><?php echo $donnees[1]; ?></td>
                <?php
                if ($profile[0] == 1||$profile[0] == 3) {?>
                <td><a href="ajoutement_categorie1.php?id=<?php echo $donnees[0];?>"><img src="res\images\edit-icon.svg" height="30x" title="modifier"></a></td>
                <td><a onclick="supprimer(<?php echo $donnees[0]; ?>)" href="#"><img src="res\images\delete-icon.svg" height="30x" title="supprimer"></a></td>
                <?php
                }
                ?>
            </tr>
    <?php
    }?>
    </tbody>
    </table></div>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center nav-item dropdown">
   Categorie 2
    <span class="badge badge-primary badge-pill nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo mysqli_num_rows($reponse3);?></span>
    <div class="dropdown-menu" aria-labelledby="dropdown03">
    <table class="table table-hover">
        <thead class="table-primary">
            <tr >
                <th scope="col">#</th>
                <th scope="col">Nom Categorie 1</th>
                <th scope="col">Nom Categorie 2</th>
                <?php
                if ($profile[0] == 1||$profile[0] == 3) {?>
                    <th class="text-center" scope="col" colspan="2" width="1%">Options</th>
                    <?php
                }
                ?>
            </tr>
        </thead>
        <tbody class="table-light">
    <?php while($donnees = mysqli_fetch_array($reponse3)){
        $donnees1=mysqli_fetch_array(mysqli_query($con,"select NOM_CATEGORE1 from categore1 where ID_CATEGORE1 = $donnees[1]"));
        ?>
            <tr>
                <th scope="row"><?php echo $donnees[0];?></th>
                <td><?php echo $donnees1[0]; ?></td>
                <td><?php echo $donnees[2]; ?></td>
                <?php
                if ($profile[0] == 1||$profile[0] == 3) {?>
                <td><a href="ajoutement_categorie1.php?id=<?php echo $donnees[0];?>"><img src="res\images\edit-icon.svg" height="30x" title="modifier"></a></td>
                <td><a onclick="supprimer(<?php echo $donnees[0]; ?>)" href="#"><img src="res\images\delete-icon.svg" height="30x" title="supprimer"></a></td>
                <?php
                }
                ?>
            </tr>
    <?php
    }?>
    </tbody>
    </table></div>
  </li>
</ul>
</div>
<?php
}
?>

 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
</body>
</html>