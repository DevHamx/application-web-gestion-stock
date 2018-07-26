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
        <title>consultation des achats</title>
    </head>
    <body>
        <?php
        include 'navbar.php';?>
        <main role="main" class="container">
        <form class="form-signin d-print-none" method="POST" action="consultation_achats.php">
        <h1 style="color:#0a8ab4;" class="text-center h3 mb-3 font-weight-bold text-uppercase">consultation des achats</h1>
        <select id="method" name="method" class="custom-select" onchange="change_method()">
            <option disabled selected>Recherche Par :</option>
            <option value="Afficher tous la list">Afficher tous la list</option>
            <option value="ID de lachat">ID de lachat</option>
            <option value="Date de lachat">Date de lachat</option>
        </select><br><br>
        <div id="valeur" >
        <input  class="form-control" type="text" name="valeur" required ></div><br>
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Rechercher">
        <br>
        <?php
        if (isset($_POST["valeur"])==false) {
            $_POST["valeur"]=0;
        }
            if (isset($_POST["valeur"])&&isset($_POST["method"])) {
                $valeur=$_POST["valeur"];
                $con=mysqli_connect("localhost","root","");
                mysqli_select_db($con,'aumk');
                if ($_POST["method"] == "ID de lachat") {
                    $reponse=mysqli_query($con,"select * from achat_fornisseur where ID_ACHAT = $valeur");
                    if (mysqli_fetch_array($reponse) == null) {?>
                        <div class="alert alert-warning text-center form-signin" role="alert">
                        Ce ID n'existe pas
                        </div>
                        <?php
                    }
                    else {
                        $reponse=mysqli_query($con,"select * from achat_fornisseur where ID_ACHAT = $valeur");
                    ?>
                    <button class="d-print-none btn btn-lg btn-success btn-block" onclick="myPrint()">print</button>
                </form>
                    <div id="table">
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr >
                                <th scope="col">#</th>
                                <th scope="col">Nom Article</th>
                                <th scope="col">CIN du responsable</th>
                                <th scope="col">Date</th>
                                <th scope="col">Quantite</th>
                                <th class="text-center d-print-none" scope="col" colspan="2" width="1%">Options</th>
                            </tr>
                        </thead>
                        <tbody class="table-light">
                    <?php while($donnees = mysqli_fetch_array($reponse)){
                        $donnees1=mysqli_fetch_array(mysqli_query($con,"select NOM_ARTICLE from article where ID_ARTICLE = $donnees[1]"));
                        $login_cin=mysqli_fetch_array(mysqli_query($con,"select CIN from utilisateurs where ID_LOGIN = $donnees[2]"));
                        ?>
                            <tr>
                                <th scope="row"><?php echo $donnees[0];?></th>
                                <td><?php echo $donnees1[0]; ?></td>
                                <td><?php echo $login_cin[0]; ?></td>
                                <td><?php echo $donnees[3]; ?></td>
                                <td><?php echo $donnees[4]; ?></td>
                                <td class="d-print-none"><a href="effectue_achat.php?id=<?php echo $donnees[0];?>"><img src="res\images\edit-icon.svg" height="30x" title="modifier"></a></td>
                                <td class="d-print-none"><a onclick="supprimer(<?php echo $donnees[0]; ?>)" href="#"><img src="res\images\delete-icon.svg" height="30x" title="supprimer"></a></td>
                            </tr>
                    <?php
                    }?>
                    </tbody>
                    </table></div>
                    <?php       
                }}
                elseif ($_POST["method"] == "Afficher tous la list") {
                    $reponse3=mysqli_query($con,"select * from achat_fornisseur");
                    ?>
                    <button class="d-print-none btn btn-lg btn-success btn-block" onclick="myPrint()">print</button>
                </form>
                    <div id=table>
                            <h1 style="display: none;" class="d-print-block">hi</h1>
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom Article</th>
                                <th scope="col">CIN du responsable</th>
                                <th scope="col">Date</th>
                                <th scope="col">Quantite</th>
                                <th class="text-center d-print-none" scope="col" colspan="2" width="1%">Options</th>
                            </tr>
                        </thead>
                        <tbody class="table-light">
                    <?php while($donnees = mysqli_fetch_array($reponse3)){
                        $donnees1=mysqli_fetch_array(mysqli_query($con,"select NOM_ARTICLE from article where ID_ARTICLE = $donnees[1]"));
                        $login_cin=mysqli_fetch_array(mysqli_query($con,"select CIN from utilisateurs where ID_LOGIN = $donnees[2]"));
                        ?>
                            <tr>
                                <th scope="row"><?php echo $donnees[0];?></th>
                                <td><?php echo $donnees1[0]; ?></td>
                                <td><?php echo $login_cin[0]; ?></td>
                                <td><?php echo $donnees[3]; ?></td>
                                <td><?php echo $donnees[4]; ?></td>
                                <td class="d-print-none"><a href="effectue_achat.php?id=<?php echo $donnees[0];?>"><img src="res\images\edit-icon.svg" height="30x" title="modifier"></a></td>
                                <td class="d-print-none"><a onclick="supprimer(<?php echo $donnees[0]; ?>)" href="#"><img src="res\images\delete-icon.svg" height="30x" title="supprimer"></a></td>
                            </tr>
                    <?php
                    }?>
                    </tbody>
                    </table></div>
                    <?php       
                }
                else {
                    $reponse2=mysqli_query($con,"select * from achat_fornisseur where DATE_ACHAT = '$valeur'");
                    if (mysqli_fetch_array($reponse2) == null) {?>
                        <div class="alert alert-warning text-center form-signin" role="alert">
                        Aucun achat n'a été effectué à cette date
                        </div>
                        <?php
                    }
                    else {
                        $reponse2=mysqli_query($con,"select * from achat_fornisseur where DATE_ACHAT = '$valeur'");?>
                        <button class="d-print-none btn btn-lg btn-success btn-block" onclick="myPrint()">print</button>
                </form>
                <div id="table">
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom Article</th>
                                <th scope="col">CIN du responsable</th>
                                <th scope="col">Date</th>
                                <th scope="col">Quantite</th>
                                <th class="text-center d-print-none" scope="col" colspan="2" width="1%">Options</th>
                            </tr>
                        </thead>
                        <tbody class="table-light">
                    <?php while($donnees = mysqli_fetch_array($reponse2)){
                        $donnees1=mysqli_fetch_array(mysqli_query($con,"select NOM_ARTICLE from article where ID_ARTICLE = $donnees[1]"));
                        $login_cin=mysqli_fetch_array(mysqli_query($con,"select CIN from utilisateurs where ID_LOGIN = $donnees[2]"));
                        ?>
                            <tr>    
                                <th scope="row"><?php echo $donnees[0];?></th>
                                <td><?php echo $donnees1[0]; ?></td>
                                <td><?php echo $login_cin[0]; ?></td>
                                <td><?php echo $donnees[3]; ?></td>
                                <td><?php echo $donnees[4]; ?></td>
                                <td class="d-print-none"><a href="effectue_achat.php?id=<?php echo $donnees[0];?>"><img src="res\images\edit-icon.svg" height="30x" title="modifier"></a></td>
                                <td class="d-print-none"><a onclick="supprimer(<?php echo $donnees[0]; ?>)" href="#"><img src="res\images\delete-icon.svg" height="30x" title="supprimer"></a></td>
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
            if (document.getElementById("method").value === "ID de lachat") {
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
            x.open("GET","supprimer.php?id4="+test,false);
            x.send(null);
            document.getElementById("table").innerHTML=x.responseText;
            return false;
        }
        </script>
        <script type="text/JavaScript">
            function myPrint() {
                window.print();
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