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
    ?>
    <form class="form-signin" method="POST" action="effectue_achat_suivant.php?id=<?php echo $id4?>">
        <h1 style="color:#0a8ab4;" class="text-center h3 mb-3 font-weight-bold text-uppercase"><?php if ($id4 != null){
                $value3="modifier un achat"; echo $value3 ;}
                else{$value3="effectue un achat";echo $value3 ;}?></h1>
        <input class="form-control" type="text" name="fournisseur" placeholder="Fournisseur" required autofocus>
        <br>
        <input class="form-control" type="number" name="ref_number" placeholder="Numéro de réference" required autofocus>
        <br>
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Suivant">
    </form>
    </body>
    </html>