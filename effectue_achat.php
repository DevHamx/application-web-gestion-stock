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
    <title>effectue un achat</title>
</head>

<body>
    <?php 
    include 'navbar.html';
    $con=mysqli_connect("localhost","root","");
    mysqli_select_db($con,'aumk');
    $reponse1 = mysqli_query($con,"select * from categore1");
    ?>
    <form class="form-signin" method="POST" action="effectue_achat.php">
        <h1 style="color:#0a8ab4;" class="text-center h3 mb-3 font-weight-bold text-uppercase">effectue un achat</h1>
        <select id="top_Categorie" name="Nom_de_la_Categorie1" class="custom-select" onchange="change_categore()">
            <option disabled selected>sélectionnez la catégorie supérieure</option>
            <?php while($row1 = mysqli_fetch_array($reponse1)):;?>
            <option value="<?php echo $row1["ID_CATEGORE1"];?>"><?php echo $row1["NOM_CATEGORE1"];?></option>
            <?php endwhile;?>
        </select>
        <br>
        <br>
        <div id="sec_Categorie">
        <select  name="Nom_de_la_Categorie2" class="custom-select">
            <option disabled selected>sélectionnez la catégorie secondaire</option>
        </select></div>
        <br>
        <br>
        <div id="article">
        <select name="Nom_de_larticle" class="custom-select">
            <option disabled selected>sélectionnez l'article</option>
        </select></div>
        <br>
        <br>
        <input class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required type="date" name="date" value="<?php echo date("Y-m-d");?>" max="<?php echo date("Y-m-d");?>">
        <br>
        <input class="form-control" type="number" name="quantity" placeholder="Quantity" required autofocus>
        <br>
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Ajouter">
        <?php
            if(isset($_POST["Nom_de_la_Categorie2"])&&isset($_POST["Nom_de_la_Categorie1"])){
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
            la Catégorie a ete ajoute avec succes
        </div>
        <?php
                    } 
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
    <script type="text/JavaScript">
    function change_categore(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","ajax.php?categorie1="+document.getElementById("top_Categorie").value+"&sec_Categorie=",false);
    xmlhttp.send(null);
    document.getElementById("sec_Categorie").innerHTML=xmlhttp.responseText;   
    if (document.getElementById("top_Categorie").value != "sélectionnez la catégorie secondaire" ) {
        document.getElementById("article").innerHTML="<select class='custom-select'><option disabled selected>sélectionnez l'article</option></select>";
    }
}
    function change_categore2(){
        var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","ajax.php?sec_Categorie="+document.getElementById("sec_Categorie2").value+"&categorie1=",false);
    xmlhttp.send(null);
    document.getElementById("article").innerHTML=xmlhttp.responseText;  
}
    </script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>