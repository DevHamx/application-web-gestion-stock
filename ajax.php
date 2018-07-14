<?php
    $con=mysqli_connect("localhost","root","");
    mysqli_select_db($con,'aumk');
    $categorie1 = $_GET['categorie1'];
    $sec_Categorie = $_GET['sec_Categorie'];
    if ($categorie1 != "") {
        $reponse2 = mysqli_query($con,"select * from categore2 where ID_CATEGORE1 = $categorie1 ");
        echo "<select id='sec_Categorie2' class='custom-select' onchange='change_categore2()'>";
        echo "<option disabled selected>sélectionnez la catégorie secondaire</option>";
        while($row1 = mysqli_fetch_array($reponse2))
        {
            echo "<option value='$row1[ID_CATEGORE2]'>"; echo $row1["NOM_CATEGORE2"]; echo "</option>";
        }
        echo "</select>";
    }

    if ($sec_Categorie != "") {
        $reponse3 = mysqli_query($con,"select * from article where ID_CATEGORE2 = $sec_Categorie ");
        echo "<select class='custom-select'>";
        echo "<option disabled selected>sélectionnez l'article</option>";
        while($row2 = mysqli_fetch_array($reponse3))
        {
            echo "<option value='$row2[ID_ARTICLE]'>"; echo $row2["NOM_ARTICLE"]; echo "</option>";
        }
        echo "</select>";
    }
    
?>