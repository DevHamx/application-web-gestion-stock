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
        $con=mysqli_connect("localhost","root","");
        mysqli_select_db($con,'aumk');
    }
    ?>
    <div class="list-form">
    <ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Articles
    <span class="badge badge-primary badge-pill">14</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Categorie
    <span class="badge badge-primary badge-pill">2</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Achat
    <span class="badge badge-primary badge-pill">1</span>
  </li>
</ul>
</div>

 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
</body>
</html>