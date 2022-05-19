<?php
session_start();
require("connection.php");
if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <link rel="stylesheet" href="style10.css">
  
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
    <title>Reports</title>

</head>

<body>
<div class='bg'>
    <nav>
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="properties.php">Properties</a></li>
            <li><a href="houses.php">Houses</a></li>
            <li><a href="payments.php">Payments</a></li>
            <li><a href="balances.php">Balances</a></li>

            <li class='right'><a href="logout.php">Logout ( <?php echo $email;?> )</a></li>
        </ul>
    </nav>
    <button class="btn btn-danger" style='margin-left: 10%;' onclick="goBack()">Back</button>
    <script>
      function goBack() {
      window.history.back();
      }
      </script> 
    <br>
    <br>
<div class='tabs'>


    <div class='panel8'>
    <h4 id='ribbon' class='well well-sm'><center><font color='black'>Reports</font></center></h4>
        <div class='houses1'>
            <a href='balances.php' style='color: black;' class='btn btn-warning btn-block'>Billing and Payment Statements</a>
                            <br>
            <a href='arrears.php' style='color: black;' class='btn btn-warning btn-block'>Total Balances for Apartments</a>
                            <br>
            <a href='statistics.php' style='color: black;' class='btn btn-warning btn-block'>Graphical Statistics</a>
            <br>
        </div>
    
    </div>
   
</div>


</div>
</body>

</html>

<?php }else{
?>
<script>window.alert("You have not Logged in");window.location="index.php";</script>
<?php
}
?>
