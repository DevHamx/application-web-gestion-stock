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
        <title>consultation des collectibles</title>
    </head>
    <body>
        <?php
        include 'navbar.php';
        $profile = $_SESSION["id_profile"];
        ?>
        <main role="main" class="container">
        <form class="form-signin" method="POST" action="consultation_collectibles.php">
        <h1 style="color:#0a8ab4;" class="text-center h3 mb-3 font-weight-bold text-uppercase">consultation des collectibles</h1>
        <select id="method" name="method" class="custom-select" onchange="change_method()">
            <option disabled selected>Recherche Par :</option>
            <option value="Afficher tous la list">Afficher tous la list</option>
            <option value="ID de la collectibles">ID de la collectibles</option>
            <option value="Date de la collectibles">Date de la collectibles</option>
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
                if ($_POST["method"] == "ID de la collectibles") {
                    $reponse=mysqli_query($con,"select * from reception where ID_RECEPTION = $valeur");
                    if (mysqli_fetch_array($reponse) == null) {?>
                        <div class="alert alert-warning text-center form-signin" role="alert">
                        Ce ID n'existe pas
                        </div>
                        <?php
                    }
                    else {
                        $reponse=mysqli_query($con,"select * from reception where ID_RECEPTION = $valeur");
                    ?>
                    <div id="table">
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr >
                                <th scope="col">#</th>
                                <th scope="col">ID Article</th>
                                <th scope="col">ID Login</th>
                                <th scope="col">Date</th>
                                <th scope="col">Quantite</th>
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
                                <td><?php echo $donnees[2]; ?></td>
                                <td><?php echo $donnees[3]; ?></td>
                                <td><?php echo $donnees[4]; ?></td>
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
                    $reponse3=mysqli_query($con,"select * from reception");
                    ?>
                    <div id=table>
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID Article</th>
                                <th scope="col">ID Login</th>
                                <th scope="col">Date</th>
                                <th scope="col">Quantite</th>
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
                                <td><?php echo $donnees[2]; ?></td>
                                <td><?php echo $donnees[3]; ?></td>
                                <td><?php echo $donnees[4]; ?></td>
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
                    $reponse2=mysqli_query($con,"select * from reception where DATE_RECEPTION = '$valeur'");
                    if (mysqli_fetch_array($reponse2) == null) {?>
                        <div class="alert alert-warning text-center form-signin" role="alert">
                        Aucun Acquisition n'a été effectué à cette date
                        </div>
                        <?php
                    }
                    else {
                        $reponse2=mysqli_query($con,"select * from reception where DATE_RECEPTION = '$valeur'");?>
                <div id="table">
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID Article</th>
                                <th scope="col">ID Login</th>
                                <th scope="col">Date</th>
                                <th scope="col">Quantite</th>
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
                                <td><?php echo $donnees[2]; ?></td>
                                <td><?php echo $donnees[3]; ?></td>
                                <td><?php echo $donnees[4]; ?></td>
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
            if (document.getElementById("method").value === "ID de la collectibles") {
                document.getElementById("valeur").innerHTML="<input id='valeur' class='form-control' type='number' name='valeur' placeholder='"+String(method)+"' required >";   
            }
            else if(document.getElementById("method").value === "Afficher tous la list"){
                document.getElementById("valeur").innerHTML=null;
            }
            else{
                document.getElementById("valeur").innerHTML="<input id='valeur' name='valeur' class='form-control' pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}' required type='date' value='<?php echo date('Y-m-d');?>' max='<?php echo date('Y-m-d');?>'>";
            }
            }
        }
        </script>
        <script type="text/JavaScript">
        function supprimer(test) {
            var x = new XMLHttpRequest();
            x.open("GET","supprimer.php?id5="+test,false);
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