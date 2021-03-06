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
    <title>effectue un achat</title>
</head>

<body>
    <?php 
    include 'navbar.php';
    if (isset($_POST["fournisseur"])&&isset($_POST["ref_number"])) {
        $_SESSION["fournisseur"]=$_POST["fournisseur"];
        $_SESSION["ref_number"]=$_POST["ref_number"];
        
    }
    $profile=$_SESSION["id_profile"];
    if ($profile[0] != 1&&$profile[0] != 3) {
        header("location:home_page.php");
    }
    if (isset($_GET['id'])) {
        $id4=$_GET['id'];   
    }
    else {
        $id4=null;
    }
    $con=mysqli_connect("localhost","root","");
    mysqli_select_db($con,'aumk');
    $reponse1 = mysqli_query($con,"select * from categore1");
    ?>
    <form class="form-signin" method="POST" action="effectue_achat_suivant.php?id=<?php echo $id4?>">
        <h1 style="color:#0a8ab4;" class="text-center h3 mb-3 font-weight-bold text-uppercase"><?php if ($id4 != null){
                $value3="modifier un achat"; echo $value3 ;}
                else{$value3="effectue un achat";echo $value3 ;}?></h1>
        <select required id="top_Categorie" name="Nom_de_la_Categorie1" class="custom-select" onchange="change_categore()">
            <option disabled selected>sélectionnez la catégorie supérieure</option>
            <?php while($row1 = mysqli_fetch_array($reponse1)):;?>
            <option value="<?php echo $row1["ID_CATEGORE1"];?>"><?php echo $row1["NOM_CATEGORE1"];?></option>
            <?php endwhile;?>
        </select>
        <br>
        <br>
        <div id="sec_Categorie">
        <select id='article2' required name="Nom_de_la_Categorie2" class="custom-select">
            <option disabled selected>sélectionnez la catégorie secondaire</option>
        </select></div>
        <br>
        <div id="article">
        <select required name="Nom_de_larticle" class="custom-select">
            <option disabled selected>sélectionnez l'article</option>
        </select></div>
        <br>
        <input class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required type="date" name="date" value="<?php echo date("Y-m-d");?>" max="<?php echo date("Y-m-d");?>">
        <br>
        <input class="form-control" type="number" name="quantity" placeholder="Quantity" required>
        <br>
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="<?php if ($id4 != null){
                $value="Modifier"; echo $value ;}
                else{$value="Ajouter";echo $value ;}?>">
        <?php
            if(isset($_COOKIE['article_id'])&&isset($_POST["date"])&&isset($_POST["quantity"])&&isset($_SESSION["id_login"])&&isset($_SESSION["fournisseur"])&&isset($_SESSION["ref_number"])){
                $fournisseur=$_SESSION["fournisseur"];
                $ref_number=$_SESSION["ref_number"];
                $date=$_POST['date'];
                $quantity=$_POST['quantity'];
                $login=$_SESSION["id_login"];
                $article_id=$_COOKIE['article_id'];
                $con=mysqli_connect("localhost","root","");
                    mysqli_select_db($con,'aumk');
                    if ($value == "Modifier"){
                        $reponse2=mysqli_fetch_array(mysqli_query($con,"select ID_ACHAT_REF from achat_fornisseur where ID_ACHAT = $id4"));
                        mysqli_query($con,"UPDATE achat_reference SET `REFERENCE_NUMBER` = '$ref_number', `FOURNISSEUR` = '$fournisseur' WHERE ID_ACHAT_REF = $reponse2[0] "); 
                        mysqli_query($con,"UPDATE achat_fornisseur SET `ID_ARTICLE` = '$article_id', `ID_LOGIN` = '$login', `DATE_ACHAT` = '$date', `QUANTITE_ACHAT` = '$quantity' WHERE ID_ACHAT = $id4 "); 
                        mysqli_close($con);?>
                        <div class="alert alert-success text-center" role="alert">
                            l'achat a ete modifier avec succes
                        </div>
                        <?php
                    }
                    else{
                        $id_achat_ref = mysqli_fetch_array(mysqli_query($con,"select * from achat_reference where REFERENCE_NUMBER = $ref_number"));
                        if ($id_achat_ref[0] == null) {
                            mysqli_query($con,"INSERT INTO `achat_reference` (`ID_ACHAT_REF`, `REFERENCE_NUMBER`, `FOURNISSEUR`) VALUES (NULL,'$ref_number','$fournisseur')");
                        } 
                        $id_achat_ref = mysqli_fetch_array(mysqli_query($con,"select * from achat_reference where REFERENCE_NUMBER = $ref_number"));
                        mysqli_query($con,"INSERT INTO `achat_fornisseur` (`ID_ACHAT`, `ID_ARTICLE`, `ID_LOGIN`, `ID_ACHAT_REF`, `DATE_ACHAT`, `QUANTITE_ACHAT`) VALUES (NULL, '$article_id', '$login', '$id_achat_ref[0]', '$date', '$quantity')"); 
                        mysqli_close($con);
                        ?>
                        </div>
                        <div class="alert alert-success text-center" role="alert">
                            l'achat a ete ajouter avec succes au réference №: <?php echo $ref_number; ?>
                        </div><br>
                        <button onclick="change_page()" class="btn btn-lg btn-success btn-block">Ajouter une autre commande</button>
                        <?php
                    }}                    
                ?>
            </form>
    <script type="text/JavaScript">
    function change_categore(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET","ajax.php?categorie1="+document.getElementById("top_Categorie").value,false);
        xmlhttp.send(null);
        document.getElementById("sec_Categorie").innerHTML=xmlhttp.responseText;   
        if (document.getElementById("top_Categorie").value != "sélectionnez la catégorie secondaire" ) {
            document.getElementById("article").innerHTML="<select class='custom-select'><option disabled selected>sélectionnez l'article</option></select>";
        }
}
    function change_categore2(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET","ajax.php?sec_Categorie="+document.getElementById("sec_Categorie2").value,false);
        xmlhttp.send(null);
        document.getElementById("article").innerHTML=xmlhttp.responseText;  
}
    function change_article() {
        if (document.getElementById("article2").value != "sélectionnez l'article") {
            var article_id = document.getElementById("article2").value;
            document.cookie="article_id="+article_id;
        }
    }

    function change_page() {
        window.open("effectue_achat.php","_self");
        return false;
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