<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/signin2.css" rel="stylesheet">
    <title>Ajouter un article</title>
</head>
<body>
<?php 
    include 'navbar.html';
    $con=mysqli_connect("localhost","root","");
    mysqli_select_db($con,'aumk');
    $reponse2 = mysqli_query($con,"select * from categore2");
    ?>
    <form class="form-signin" method="POST" action="ajoutement_articles.php">
    <h1 style="color:#0a8ab4;" class="text-center h3 mb-3 font-weight-bold text-uppercase">articles</h1>
            <label class="sr-only" for="Nom_de_lartcile">Nom de l'article</label>
            <input class="form-control" type="text" name="Nom_de_lartcile" placeholder="Nom de l'article" required autofocus><br>
            </select>
            <select name="Nom_de_la_Categorie2" class="custom-select">
                <option disabled selected>sélectionnez la catégorie secondaire</option>
                <?php while($row2 = mysqli_fetch_array($reponse2)):;?>
                <option><?php echo $row2[2];?></option>
                <?php endwhile;?>
            </select><br><br>
            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Ajouter">
    <?php
            if(isset($_POST["Nom_de_la_Categorie2"])&&isset($_POST["Nom_de_lartcile"])){
                $exist = 0;
                $Nom2=$_POST['Nom_de_la_Categorie2'];
                $Nom3=$_POST['Nom_de_lartcile'];
                $con=mysqli_connect("localhost","root","");
                    mysqli_select_db($con,'aumk');
                    $result2 = mysqli_query($con,"select ID_CATEGORE2 from categore2 where NOM_CATEGORE2 = '$Nom2' ");
                    $id2 = mysqli_fetch_array($result2);
                    $reponse3 = mysqli_query($con,"select * from article");
                    while($donnees = mysqli_fetch_array($reponse3)){
                        $test = strcmp($Nom3,$donnees['NOM_ARTICLE']);
                        if($test == 0){
                            $exist = 1;
                            break;
                        }
                    }
                    if ($exist == 0) {
                        mysqli_query($con,"INSERT INTO article (`ID_CATEGORE2`,`NOM_ARTICLE`) VALUES ($id2[0],'$Nom3')"); 
                        mysqli_close($con);
                        ?>              
                            </div>
                            <div class="alert alert-success text-center" role="alert">
                            l'article a ete ajoute avec succes
                            </div>
                        <?php
                    } 
                    else {
                        mysqli_close($con);
                        ?>
                        <div class="alert alert-warning text-center" role="alert">
                        Ce article est deja existe
                        </div>
                        <?php
                    }}                     
                ?>
                </form>
 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
</body>
</html>