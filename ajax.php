<?php
    $con=mysqli_connect("localhost","root","");
    mysqli_select_db($con,'aumk');
    if (isset($_GET['categorie1'])){
        $categorie1 = $_GET['categorie1'];
    if ($categorie1 != "") {
        $reponse2 = mysqli_query($con,"select * from categore2 where ID_CATEGORE1 = $categorie1 ");
        echo "<select required id='sec_Categorie2' name='Nom_de_la_Categorie2' class='custom-select' onchange='change_categore2()'>";
        echo "<option disabled selected>sélectionnez la catégorie secondaire</option>";
        while($row1 = mysqli_fetch_array($reponse2))
        {
            echo "<option value='$row1[ID_CATEGORE2]'>"; echo $row1["NOM_CATEGORE2"]; echo "</option>";
        }
        echo "</select>";
    }}
    if (isset($_GET['sec_Categorie'])){
        $sec_Categorie = $_GET['sec_Categorie'];
    if ($sec_Categorie != "") {
        $reponse3 = mysqli_query($con,"select * from article where ID_CATEGORE2 = $sec_Categorie ");
        echo "<select id='article2' required name='Nom_de_larticle' class='custom-select' onchange='change_article()'>";
        echo "<option disabled selected>sélectionnez l'article</option>";
        while($row2 = mysqli_fetch_array($reponse3))
        {
            echo "<option value='$row2[ID_ARTICLE]'>"; echo $row2["NOM_ARTICLE"]; echo "</option>";
        }
        echo "</select>";
    }}
    
?>