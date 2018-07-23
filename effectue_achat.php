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
    if (isset($_GET['id'])) {
        $id4=$_GET['id'];   
    }
    else {
        $id4=null;
    }
    include 'navbar.html';
    $con=mysqli_connect("localhost","root","");
    mysqli_select_db($con,'aumk');
    $reponse1 = mysqli_query($con,"select * from categore1");
    ?>
    <form class="form-signin" method="POST" action="effectue_achat.php?id=<?php echo $id4?>">
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
        <input class="form-control" type="number" name="quantity" placeholder="Quantity" required autofocus>
        <br>
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="<?php if ($id4 != null){
                $value="Modifier"; echo $value ;}
                else{$value="Ajouter";echo $value ;}?>">
        <?php
            if(isset($_COOKIE['article_id'])&&isset($_POST["date"])&&isset($_POST["quantity"])&&isset($_SESSION["id_login"])){
                $date=$_POST['date'];
                $quantity=$_POST['quantity'];
                $login=$_SESSION["id_login"];
                $article_id=$_COOKIE['article_id'];
                $con=mysqli_connect("localhost","root","");
                    mysqli_select_db($con,'aumk');
                    if ($value == "Modifier"){
                        mysqli_query($con,"UPDATE achat_fornisseur SET `ID_ARTICLE` = '$article_id', `ID_LOGIN` = '$login', `DATE_ACHAT` = '$date', `QUANTITE_ACHAT` = '$quantity' WHERE ID_ACHAT = $id4 "); 
                        mysqli_close($con);?>
                        <div class="alert alert-success text-center" role="alert">
                            l'achat a ete modifier avec succes
                        </div>
                        <?php
                    }
                    else{
                        mysqli_query($con,"INSERT INTO `achat_fornisseur` (`ID_ACHAT`, `ID_ARTICLE`, `ID_LOGIN`, `DATE_ACHAT`, `QUANTITE_ACHAT`) VALUES (NULL,'$article_id','$login','$date','$quantity')"); 
                        mysqli_close($con);
                        ?>
                        </div>
                        <div class="alert alert-success text-center" role="alert">
                            l'achat a ete effectue avec succes
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
    function change_article() {
        if (document.getElementById("article2").value != "sélectionnez l'article") {
            var article_id = document.getElementById("article2").value;
            document.cookie="article_id="+article_id;
        }
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