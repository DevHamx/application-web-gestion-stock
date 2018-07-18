<?php
    $con=mysqli_connect("localhost","root","");
    mysqli_select_db($con,'aumk');
    if (isset($_GET['id'])) {
    $id=$_GET['id'];
    if ($id != ""){
        $result = mysqli_query($con,"SELECT * FROM categore2 WHERE ID_CATEGORE1=$id");
        $row=mysqli_fetch_array($result);
        if ( $row[0] == null) {
            mysqli_query($con,"DELETE FROM categore1 WHERE ID_CATEGORE1=$id");
            echo "<div class='alert alert-success text-center form-signin' role='alert'>La categorie a ete supprimer avec succes</div>";
        }
        else {
            echo "<div class='alert alert-warning text-center form-signin' role='alert'>vous doit supprimer les sous catégories avant de supprimer cette catégorie car ils ont relient</div>";
        }   
    }
    mysqli_close($con); 
}
    if (isset($_GET['id2'])) {
        $id2=$_GET['id2'];
        if ($id2 != ""){
            $result2 = mysqli_query($con,"SELECT * FROM article WHERE ID_CATEGORE2=$id2");
            $row2=mysqli_fetch_array($result2);
            if ( $row2[0] == null) {
                mysqli_query($con,"DELETE FROM categore2 WHERE ID_CATEGORE2=$id2");
                echo "<div class='alert alert-success text-center form-signin' role='alert'>La categorie a ete supprimer avec succes</div>";
            }
            else {
                echo "<div class='alert alert-warning text-center form-signin' role='alert'>vous doit supprimer les sous catégories avant de supprimer cette catégorie car ils ont relient</div>";
            }            
        }
        mysqli_close($con);
    }
?>