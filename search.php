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
    <title>Search</title>
    <style>
        .list-form {
      margin-top: 150px;
      width: 100%;
      max-width: 1000px;
      padding: 15px;
      margin-left: auto;
      margin-right: auto;
  }
    </style>
</head>
<body>
<?php
    include 'navbar.php';
    if (isset($_GET['search'])) {
      $search = $_GET['search'];
        $con=mysqli_connect("localhost","root","");
        mysqli_select_db($con,'aumk');
        $reponse = mysqli_query($con,"select * from article where NOM_ARTICLE like '%$search%'");
        $donnee = mysqli_fetch_array($reponse);
        $reponse2 = mysqli_query($con,"select * from categore1 where NOM_CATEGORE1 like '%$search%'");
        $donnee2 = mysqli_fetch_array($reponse2);
        $reponse3 = mysqli_query($con,"select * from categore2 where NOM_CATEGORE2 like '%$search%'");
        $donnee3 = mysqli_fetch_array($reponse3);
    ?>
    <div class="list-form">
    <ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Articles
    <span class="badge badge-primary badge-pill"><?php echo mysqli_num_rows($reponse);?></span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Categorie 1
    <span class="badge badge-primary badge-pill"><?php echo mysqli_num_rows($reponse2);?></span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
   Categorie 2
    <span class="badge badge-primary badge-pill"><?php echo mysqli_num_rows($reponse3);?></span>
  </li>
</ul>
</div>
<?php
}
?>

 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
</body>
</html>