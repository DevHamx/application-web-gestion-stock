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
        <title>Rechercher un article</title>
    </head>
    <body>
        <?php
        include 'navbar.php';
        $profile = $_SESSION["id_profile"];
        ?>
        <main role="main" class="container">
        <form class="form-signin" method="POST" action="Rechercher_articles.php">
        <h1 style="color:#0a8ab4;" class="text-center h3 mb-3 font-weight-bold text-uppercase">Recherche dans les articles </h1>
        <select id="method" name="method" class="custom-select" onchange="change_method()">
            <option disabled selected>Recherche Par :</option>
            <option value="Afficher tous la list">Afficher tous la list</option>
            <option value="ID de larticle">ID de larticle</option>
            <option value="Nom de larticle">Nom de larticle</option>
        </select><br><br>
        <div id="valeur" >
        <input  class="form-control" type="text" name="valeur" required ></div><br>
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Rechercher">
        </form><br>
        <?php
        if (isset($_POST["valeur"])==false) {
            $_POST["valeur"]=0;
        }
            if (isset($_POST["valeur"])&&isset($_POST["method"])) {
                $valeur=$_POST["valeur"];
                $con=mysqli_connect("localhost","root","");
                mysqli_select_db($con,'aumk');
                if ($_POST["method"] == "ID de larticle") {
                    $reponse=mysqli_query($con,"select * from article where ID_ARTICLE = $valeur");
                    if (mysqli_fetch_array($reponse) == null) {?>
                        <div class="alert alert-warning text-center form-signin" role="alert">
                        Ce ID n'existe pas
                        </div>
                        <?php
                    }
                    else {
                        $reponse=mysqli_query($con,"select * from article where ID_ARTICLE = $valeur");
                    ?>
                    <div id="table">
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr >
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
                            $donnees1=mysqli_fetch_array(mysqli_query($con,"select NOM_CATEGORE2 from categore2 where ID_CATEGORE2 = $donnees[1]"));
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
                    <?php       
                }}
                elseif ($_POST["method"] == "Afficher tous la list") {
                    $reponse3=mysqli_query($con,"select * from article");
                    ?>
                    <div id=table>
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
                    <?php       
                }
                else {
                    $reponse2=mysqli_query($con,"select * from article where NOM_article like '%$valeur%'");
                    if (mysqli_fetch_array($reponse2) == null) {?>
                        <div class="alert alert-warning text-center form-signin" role="alert">
                        Ce Nom n'existe pas
                        </div>
                        <?php
                    }
                    else {
                        $reponse2=mysqli_query($con,"select * from article where NOM_article like '%$valeur%'");?>
                <div id="table">
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
                    <?php while($donnees = mysqli_fetch_array($reponse2)){
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
                    <?php
                }}
            }
        ?>
        </main><!-- /.container -->
        <script type="text/JavaScript">
        function change_method() {
        if (document.getElementById("method").value != "Recherche Par :") {
            var method = document.getElementById("method").value;
            if (document.getElementById("method").value === "ID de larticle") {
                document.getElementById("valeur").innerHTML="<input id='valeur' class='form-control' type='number' name='valeur' placeholder='"+String(method)+"' required >";   
            }
            else if(document.getElementById("method").value === "Afficher tous la list"){
                document.getElementById("valeur").innerHTML=null;
            }
            else{
                document.getElementById("valeur").innerHTML="<input id='valeur' class='form-control' type='text' name='valeur' placeholder='"+String(method)+"' required >";
            }
            }
        }
        </script>
        <script type="text/JavaScript">
        function supprimer(test) {
            var x = new XMLHttpRequest();
            x.open("GET","supprimer.php?id3="+test,false);
            x.send(null);
            document.getElementById("table").innerHTML=x.responseText;
            return false;
        }
        </script>
        <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    </body>
</html>