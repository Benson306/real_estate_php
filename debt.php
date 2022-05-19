<?php
session_start();
require("connection.php");
if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
    $listID = $_SESSION['listID'];

    $sql3 = "SELECT * FROM property WHERE property_id = '$listID'";
        $run3 = mysqli_query($conn, $sql3);
        $rows3= mysqli_fetch_assoc($run3);
        $name = $rows3['name'];
        $shortcode = $rows3['shortCode'];
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
  <link rel="stylesheet" href="style4.css">

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
    <title>Settle Debts</title>

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
      window.history.back();
      }
      </script> 
      <br>
      <br>
      <br>
<div class='tabs'>      
    <div class='pan1'>

            <h4 id='ribbon' class='well well-sm'><center><font color='black'>Write Off Debts in <?php echo $name?> Apartment:</font></center></h4>
            <form method='post' class='form-group' id='form'>
                <label>House Number:</label>
                <select class='form-control' required='yes' name='house'>
                    <option></option>
                    <?php 
                    $sql5 = "SELECT * FROM houses WHERE apartment = '$name' ";
                    $run5 = mysqli_query($conn,$sql5);
                    while($rows5=mysqli_fetch_assoc($run5)){
                        ?>
                        <option value='<?php echo $rows5['number'];?>'><?php echo $rows5['number'];?></option>
                        <?php
                    };
                    ?>
                </select>
                <br>
                <label>Year and Month Being Settled for?</label>
                <input type='month' name='month' class='form-control' required='yes' value='<?php echo $rows5['rent'];?>'>
                <br>
                <label>Amount</label>
                <input type='number' name='amount' class='form-control' required='yes' value='<?php echo $rows5['rent'];?>'>
                <br>
                <input type='submit' name='settle' value='Settle Debts' class='btn btn-danger'>
            </form>
        
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
if(isset($_POST['settle'])){
    $house = mysqli_real_escape_string($conn,strip_tags($_POST['house']));
    $month = mysqli_real_escape_string($conn,strip_tags($_POST['month']));
    $amount = mysqli_real_escape_string($conn,strip_tags($_POST['amount']));

    $date = '20'.date('ymdhis');
    $date= (string)$date;

    $newdate1 = $date[8].$date[9];

    $newdate2 = $newdate1 + 3;

    if($newdate2<10){
        $newdate2 = '0'.$newdate2;
    }

    $finalDate = $date[0].$date[1].$date[2].$date[3].$date[4].$date[5].$date[6].$date[7].$newdate2.$date[10].$date[11].$date[12].$date[13];

    $finalDate;


    $sql = "INSERT INTO mpesa(TransType, TransID, TransTime, TransAmount, BusinessShortCode, BillRefNumber, InvoiceNumber, OrgAccBalance, ThirdPartyTransID, MSISDN, FirstName, MiddleName, LastName, monthMPESA) VALUES ('Settled','Settled','$finalDate','$amount','$shortcode','$house','Settled','settled','Settled','Settled','Settled','Settled','Settled', '$month')";

    if(mysqli_query($conn, $sql)){
        ?>
        <script>
            window.alert("You have succesfully Settled A Debt");
            window.location="debt.php";
        </script>
        <?php
    }else{
        ?>
        <script>
            window.alert("Server Error Try again");
            window.location="debt.php";
        </script>
        <?php
    }
}

