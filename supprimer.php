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
    if (isset($_GET['id3'])) {
        $id3=$_GET['id3'];
        if ($id3 != ""){
            $result3 = mysqli_query($con,"SELECT * FROM achat_fornisseur WHERE ID_ARTICLE=$id3");
            $result4 = mysqli_query($con,"SELECT * FROM reception WHERE ID_ARTICLE=$id3");
            $row2=mysqli_fetch_array($result3);
            $row3=mysqli_fetch_array($result4);
            if ( ($row2[0] == null)&&($row3[0] == null)) {
                mysqli_query($con,"DELETE FROM article WHERE ID_ARTICLE=$id3");
                echo "<div class='alert alert-success text-center form-signin' role='alert'>L'article a ete supprimer avec succes</div>";
            }
            else {
                echo "<div class='alert alert-warning text-center form-signin' role='alert'>vous doit supprimer les sous catégories avant de supprimer cette catégorie car ils ont relient</div>";
            }            
        }
        mysqli_close($con);
    }
    if (isset($_GET['id4'])) {
        $id4=$_GET['id4'];
        if ($id4 != ""){
                mysqli_query($con,"DELETE FROM achat_fornisseur WHERE ID_ACHAT=$id4");
                echo "<div class='alert alert-success text-center form-signin' role='alert'>L'achat a ete supprimer avec succes</div>";
            }   
            mysqli_close($con);         
        }
    if (isset($_GET['id5'])) {
        $id5=$_GET['id5'];
        if ($id5 != ""){
                mysqli_query($con,"DELETE FROM reception WHERE ID_RECEPTION=$id5");
                echo "<div class='alert alert-success text-center form-signin' role='alert'>La collectible a ete supprimer avec succes</div>";
            }   
            mysqli_close($con);         
        }
?>