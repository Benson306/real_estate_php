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
  <link rel="stylesheet" href="style9.css">
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
    <title>Dashboard</title>

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
    <br><br>
<div class='panel'>
    <div class="inside">
       <a href="properties.php"> <img src='images/property.png' height='80px' width='80px'>
        <br>
        <br>
        Manage Apartments</a>
    </div>
    <div class="inside">
    <a href="houses.php"> <img src='images/houses.png' height='80px' width='80px'>
        <br>
        <br>
        House Units</a>
    </div>
    <div class="inside">
    <a href="tenants.php"> <img src='images/tenants.png' height='80px' width='80px'>
        <br>
        <br>
        Tenants Details</a>
    </div>
    <div class="inside">
    <a href="billing.php"> <img src='images/bill.png' height='90px' width='80px'>
        <br>
        <br>
        Bill Tenants</a>
    </div>
    <div class="inside">
    <a href="payments.php"> <img src='images/payement.png' height='80px' width='60px'>
        <br>
        <br>
          <div style='margin-left: 7%;'>Payments</div></a>
    </div>
    
</div>
<br><br>
<div class='panel'>
    <div class="inside">
        <br>
        <a href="houseBalances.php"> <img src='images/balance.png' height='60px' width='80px'>
        <br>
        <br>
        Balances</a>
    </div>
    <div class="inside">
    <a href="receipts.php"> <img src='images/receipts.png' height='80px' width='80px'>
        <br>
        <br>
          <div style='margin-left: 7%;'> Print Receipts</div></a>
    </div>
    <div class="inside">
    <a href="reports.php"> <img src='images/reports.png' height='80px' width='80px'>
        <br>
        <br>
        Reports</a>
    </div>
    <div class="inside">
    <a href="#"> <img src='images/sms.png' height='80px' width='80px'>
        <br>
        <br>
        Send Bulk SMS</a>
    </div>
    <div class="inside">
    <a href="users.php"> <img src='images/users.png' height='80px' width='80px'>
        <br>
        <br>
        Manage Users</a>
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