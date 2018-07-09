<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <form method="POST" action="index.php">
            <label for="CIN">CIN</label>
            <input type="text" name="CIN"><br>
            <label for="password">password</label>
            <input type="password" name="password"><br>
            <input type="submit" value="Log In">
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