<?php
session_start();
require("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <link rel="stylesheet" href="style11.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- End of bootsrap -->


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Estate Management</title>

</head>

<body>
<div class='bg'>
    <br>
    <h3 id='ribbon' class='well well-sm'><center>Property Management System</center></h3>
        <form class='form-group' method='post' id='login'>
        <label>Email</label>
        <br>
        <input type='email' class='form-control' name='email' required='yes'>
        <br>
        <label>Password</label>
        <br>
        <input type='password' class='form-control' name='password' required='yes'>
        <br>
        <input type='submit' value='Login' name='submit' style='color: black;' class='btn btn-warning'> 
        <br>
        </form>
</div>
</body>

</html>


<?php 

if(isset($_POST['submit'])){
$email = mysqli_real_escape_string($conn,strip_tags($_POST['email']));
$password = mysqli_real_escape_string($conn,strip_tags($_POST['password']));

$sql = "SELECT * FROM users WHERE email = '$email'";
$run = mysqli_query($conn, $sql);
$rows= mysqli_fetch_assoc($run);

$count = mysqli_num_rows($run);

    if($count > 0){
        if($password == $rows['password']){
            ?>
            <script>
            window.location='dashboard.php';
            </script>
            <?php
             
             $_SESSION['email']=$email;
        }else{
            ?>
            <script>
                window.alert("Incorrect Password");
                window.location='index.php';
            </script>
            <?php
        }
    }else{
        ?>
        <script>   
        window.alert("User does not exist");
        window.location="index.php";
        </script>
        <?php
    }
}



?>