<?php
    $con=mysqli_connect("localhost","root","");
    mysqli_select_db($con,'aumk');
    if (isset($_GET['id'])) {
    $id=$_GET['id'];
    if ($id != ""){
        mysqli_query($con,"DELETE FROM achat_fornisseur WHERE ID_ARTICLE in (select ID_ARTICLE from article join categore2 join categore1 on categore2.ID_CATEGORE2=article.ID_CATEGORE2 and categore2.ID_CATEGORE1=categore1.ID_CATEGORE1
        where categore1.ID_CATEGORE1=$id)");
        mysqli_query($con,"DELETE FROM reception WHERE ID_ARTICLE in (select ID_ARTICLE from article join categore2 join categore1 on categore2.ID_CATEGORE2=article.ID_CATEGORE2 and categore2.ID_CATEGORE1=categore1.ID_CATEGORE1
        where categore1.ID_CATEGORE1=$id)");
        mysqli_query($con,"");
        mysqli_query($con,"DELETE FROM article WHERE ID_CATEGORE2 in (select ID_CATEGORE2 from categore2 where ID_CATEGORE1=$id)");
        mysqli_query($con,"DELETE FROM categore2 WHERE ID_CATEGORE1=$id");
        mysqli_query($con,"DELETE FROM categore1 WHERE ID_CATEGORE1=$id");
    }
    mysqli_close($con); 
}
    if (isset($_GET['id2'])) {
        $id2=$_GET['id2'];
        if ($id2 != ""){
            mysqli_query($con,"DELETE FROM achat_fornisseur WHERE ID_ARTICLE in (select ID_ARTICLE from article join categore2 join categore1 on categore2.ID_CATEGORE2=article.ID_CATEGORE2 and categore2.ID_CATEGORE1=categore1.ID_CATEGORE1
            where categore1.ID_CATEGORE1=$id2)");
            mysqli_query($con,"DELETE FROM reception WHERE ID_ARTICLE in (select ID_ARTICLE from article join categore2 join categore1 on categore2.ID_CATEGORE2=article.ID_CATEGORE2 and categore2.ID_CATEGORE1=categore1.ID_CATEGORE1
            where categore1.ID_CATEGORE1=$id2)");
            mysqli_query($con,"");
            mysqli_query($con,"DELETE FROM article WHERE ID_CATEGORE2 in (select ID_CATEGORE2 from categore2 where ID_CATEGORE1=$id2)");
            mysqli_query($con,"DELETE FROM categore2 WHERE ID_CATEGORE2=$id2");
        }
        mysqli_close($con);
    }
?>