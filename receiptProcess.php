<?php
session_start();
require("connection.php");
require_once __DIR__ . '/vendor/autoload.php';
if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
    $listID = $_SESSION['listID'];

    $sql3 = "SELECT * FROM property WHERE property_id = '$listID'";
        $run3 = mysqli_query($conn, $sql3);
        $rows3= mysqli_fetch_assoc($run3);
        $name = $rows3['name'];

        
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <link rel="stylesheet" href="style8.css">

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
    <title>Balances</title>

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

                <h3 id='ribbon' class='well well-sm'><center>Print Receipts in <?php echo $rows3['name']; ?> Apartment:</center></h3>

    <div class='tabs'> 
    <div class='panel8'>   
    <h3 id='ribbon' style='color: black;' class='well well-sm'><center>Select The Month To print Out Receipts:</center></h3> 
   <?php 
   $sql3 = "SELECT * FROM property WHERE property_id = '$listID'";
   $run3 = mysqli_query($conn, $sql3);
   $rows3= mysqli_fetch_assoc($run3);
   $name = $rows3['name'];

   $sql = "SELECT * FROM billing WHERE apartment='$name' GROUP BY month";
   $run = mysqli_query($conn, $sql);
   while($rows= mysqli_fetch_assoc($run)){
                       echo "<div class='houses'>";
                       echo "<a href='receiptProcess.php?month_id=$rows[month]' style='color: black;' class='btn btn-warning btn-block'>$rows[month]</a>";
                       echo "<br>";
                       echo "<br>";
                       echo "</div>";
   };

   
   ?>

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
<?php

if(isset($_GET['month_id'])){
    $monthID = $_GET['month_id'];
    $_SESSION['monthID']=$monthID; ?>
    <script>window.location="receiptPDF.php"</script>
    <?php
}

?>


