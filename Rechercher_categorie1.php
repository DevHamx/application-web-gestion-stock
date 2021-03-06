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
        <title>Rechercher une catégorie</title>
    </head>
    <body>
        <?php
        include 'navbar.php';
        $profile = $_SESSION["id_profile"];
        ?>
        <main role="main" class="container">
        <form class="form-signin" method="POST" action="Rechercher_categorie1.php">
        <h1 style="color:#0a8ab4;" class="text-center h3 mb-3 font-weight-bold text-uppercase">Recherche dans les Catégories globale</h1>
        <select id="method" name="method" class="custom-select" onchange="change_method()">
            <option disabled selected>Recherche Par :</option>
            <option value="Afficher toute la list">Afficher toute la list</option>
            <option value="ID de la catégorie">ID de la catégorie</option>
            <option value="Nom de la catégorie">Nom de la catégorie</option>
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
                if ($_POST["method"] == "ID de la catégorie") {
                    $reponse=mysqli_query($con,"select * from categore1 where ID_CATEGORE1 = $valeur");
                    if (mysqli_fetch_array($reponse) == null) {?>
                        <div class="alert alert-warning text-center form-signin" role="alert">
                        Ce ID n'existe pas
                        </div>
                        <?php
                    }
                    else {
                        $reponse=mysqli_query($con,"select * from categore1 where ID_CATEGORE1 = $valeur");
                    ?>
                    <div id=table>
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
                    <?php while($donnees = mysqli_fetch_array($reponse)){?>
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
                    <?php       
                }}
                elseif ($_POST["method"] == "Afficher toute la list") {
                    $reponse3=mysqli_query($con,"select * from categore1");
                    ?>
                    <div id=table>
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
                    <?php while($donnees = mysqli_fetch_array($reponse3)){?>
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
                    <?php       
                }
                else {
                    $reponse2=mysqli_query($con,"select * from categore1 where NOM_CATEGORE1 like '%$valeur%'");
                    if (mysqli_fetch_array($reponse2) == null) {?>
                        <div class="alert alert-warning text-center form-signin" role="alert">
                        Ce Nom n'existe pas
                        </div>
                        <?php
                    }
                    else {
                        $reponse2=mysqli_query($con,"select * from categore1 where NOM_CATEGORE1 like '%$valeur%'");?>
                <div id="table">
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
                    <?php
                }}
            }
        ?>
        </main><!-- /.container -->
        <script type="text/JavaScript">
        function change_method() {
        if (document.getElementById("method").value != "Recherche Par :") {
            var method = document.getElementById("method").value;
            if (document.getElementById("method").value === "ID de la catégorie") {
                document.getElementById("valeur").innerHTML="<input id='valeur' class='form-control' type='number' name='valeur' placeholder='"+String(method)+"' required >";   
            }
            else if(document.getElementById("method").value === "Afficher toute la list"){
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
            x.open("GET","supprimer.php?id="+test,false);
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