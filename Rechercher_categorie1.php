<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/signin.css" rel="stylesheet">
        <title>Rechercher une catégorie</title>
    </head>
    <body>
        <?php
        include 'navbar.html';?>
        <main role="main" class="container">
        <form class="form-signin" method="POST" action="Rechercher_categorie1.php">
        <h1 style="color:#0a8ab4;" class="text-center h3 mb-3 font-weight-bold text-uppercase">Recherche dans la Catégorie 1</h1>
        <select id="method" name="method" class="custom-select" onchange="change_method()">
            <option disabled selected>Recherche Par :</option>
            <option value="ID de la catégorie">ID de la catégorie</option>
            <option value="Nom de la catégorie">Nom de la catégorie</option>
        </select><br><br>
        <div id="valeur" >
        <input  class="form-control" type="text" name="valeur" required ></div><br>
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Rechercher">
        </form><br>
        <?php
            if (isset($_POST["valeur"])&&isset($_POST["method"])) {
                $valeur=$_POST["valeur"];
                $con=mysqli_connect("localhost","root","");
                mysqli_select_db($con,'aumk');
                if ($_POST["method"] == "ID de la catégorie") {
                    $reponse=mysqli_query($con,"select * from categore1 where ID_CATEGORE1 = $valeur");?>
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary">
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col" colspan="2">Options</th>
                            </tr>
                        </thead>
                        <tbody class="table-light">
                    <?php while($donnees = mysqli_fetch_array($reponse)){?>
                            <tr class="text-center">
                                <th scope="row"><?php echo $donnees[0]; ?></th>
                                <td><?php echo $donnees[1]; ?></td>
                                <td><a href="#"><img src="res\images\edit-icon.svg" height="30x" title="modifier"></a></td>
                                <td><a href="#"><img src="res\images\delete-icon.svg" height="30x" title="supprimer"></a></td>
                            </tr>
                    <?php
                    }?>
                    </tbody>
                    </table> 
                    <?php       
                }
                else {
                    $reponse2=mysqli_query($con,"select * from categore1 where NOM_CATEGORE1 = '$valeur'");?>
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary">
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col" colspan="2">Options</th>
                            </tr>
                        </thead>
                        <tbody class="table-light">
                    <?php while($donnees = mysqli_fetch_array($reponse2)){?>
                            <tr class="text-center">    
                                <th scope="row"><?php echo $donnees[0]; ?></th>
                                <td><?php echo $donnees[1]; ?></td>
                                <td><a href="#"><img src="res\images\edit-icon.svg" height="30x" title="modifier"></a></td>
                                <td><a href="#"><img src="res\images\delete-icon.svg" height="30x" title="supprimer"></a></td>
                            </tr>
                    <?php
                    }?>
                    </tbody>
                    </table> 
                    <?php
                }
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
            else{
                document.getElementById("valeur").innerHTML="<input id='valeur' class='form-control' type='text' name='valeur' placeholder='"+String(method)+"' required >";
            }
            }
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