<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link href="css/signin.css" rel="stylesheet">
    </head>
    <body class="text-center">
        <form class="form-signin" method="POST" action="index.php">
            <img class="mb-4" src="res\images\entete_site.png" ><br>
            <h1 style="color:#0a8ab4;" class="h3 mb-3 font-weight-normal">Please Log in</h1>
            <label class="sr-only" for="CIN">CIN</label>
            <input class="form-control" type="text" name="CIN" placeholder="CIN" required autofocus><br>
            <label class="sr-only" for="password">password</label>
            <input class="form-control" type="password" name="password" placeholder="password" required autofocus><br>
            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Log In">
        </form>
        <?php
            if(isset($_POST["CIN"])&&isset($_POST['password'])){
                $var=0;
                $login1=$_POST['CIN'];
                $password1=$_POST['password'];
                $con=mysqli_connect("localhost","root","");
                    mysqli_select_db($con,'aumk');
                    $reponse = mysqli_query($con,"select * from utilisateurs");
                    while($donnees = mysqli_fetch_array($reponse)){
                        if((strcmp($login1,$donnees['CIN'])==0)&&(strcmp($password1,$donnees['password'])==0)){
                            header("location:page.html");
                        }
                        else $var=1;}
                 mysqli_close($con);
                 if($var==1)
                  echo"error";}
        ?>
    </body>
</html>