<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
    <title>Ajouter dans la Catégorie 2</title>
</head>
<body>
<?php 
    include 'navbar.html';
    $_SESSION["id_categorie2"];
    $id2=$_SESSION["id_categorie2"];
    $con=mysqli_connect("localhost","root","");
    mysqli_select_db($con,'aumk');
    $reponse1 = mysqli_query($con,"select * from categore1");
    ?>
    <form class="form-signin" method="POST" action="ajoutement_categorie2.php">
    <h1 style="color:#0a8ab4;" class="text-center h3 mb-3 font-weight-bold text-uppercase">Catégorie 2</h1>
            <label class="sr-only" for="Nom_de_la_Categorie2">Nom de la Catégorie</label>
            <input class="form-control" type="text" name="Nom_de_la_Categorie2" placeholder="<?php if ($id2 != null){
                $value2="Le nouveau nom de la Catégorie"; echo $value2 ;$_SESSION["id_categorie"] = null; }
                else{$value2="Nom de la Catégorie";echo $value2 ;}?>" required autofocus><br>
            <select name="Nom_de_la_Categorie1" class="custom-select">
                <option disabled selected>sélectionnez la catégorie supérieure</option>
                <?php while($row1 = mysqli_fetch_array($reponse1)):;?>
                <option><?php echo $row1[1];?></option>
                <?php endwhile;?>
            </select><br><br>
            <input class="btn btn-lg btn-primary btn-block" type="submit" value="<?php if ($id2 != null){
                $value="Modifier"; echo $value ;$_SESSION["id_categorie"] = null; }
                else{$value="Ajouter";echo $value ;}?>">
    <?php
            if(isset($_POST["Nom_de_la_Categorie2"])&&isset($_POST["Nom_de_la_Categorie1"])){
                $exist = 0;
                $Nom1=$_POST["Nom_de_la_Categorie1"];
                $Nom2=$_POST['Nom_de_la_Categorie2'];
                $con=mysqli_connect("localhost","root","");
                    mysqli_select_db($con,'aumk');
                    $result = mysqli_query($con,"select ID_CATEGORE1 from categore1 where NOM_CATEGORE1 = '$Nom1' ");
                    $id = mysqli_fetch_array($result);
                    $reponse2 = mysqli_query($con,"select * from categore2");
                    while($donnees = mysqli_fetch_array($reponse2)){
                        $test = strcmp($Nom2,$donnees['NOM_CATEGORE2']);
                        if($test == 0){
                            $exist = 1;
                            break;
                        }
                    }
                    if ($exist == 0) {
                        if ($value == "Modifier"){
                            mysqli_query($con,"UPDATE categore2 SET NOM_CATEGORE2= '$Nom2',ID_CATEGORE1=$id[0]  WHERE ID_CATEGORE2 = $id2 "); 
                            $_SESSION["id_categorie2"] = null;
                            mysqli_close($con);?>
                            <div class="alert alert-success text-center" role="alert">
                                la Catégorie a ete modifier avec succes
                            </div>
                            <?php
                        }
                        else{
                        mysqli_query($con,"INSERT INTO categore2 (`ID_CATEGORE1`,`NOM_CATEGORE2`) VALUES ($id[0],'$Nom2')"); 
                        mysqli_close($con);
                        ?>              
                            </div>
                            <div class="alert alert-success text-center" role="alert">
                                la Catégorie a ete ajoute avec succes
                            </div>
                        <?php
                    }}
                    else {
                        mysqli_close($con);
                        ?>
                        <div class="alert alert-warning text-center" role="alert">
                        Cette Catégorie est deja existe
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