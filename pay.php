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

        
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <link rel="stylesheet" href="style7.css">

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
    <title>Payments</title>

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
    <br>
    <div class='well well-sm' style='margin-left: 10%; width: 80%;'>
        <a href='debt.php' class='btn btn-primary' style='margin-left: 5%;'>Settle Debts In This Apartment</a>
    </div>
    
    <?php
    if(isset($_GET['edit_id'])){
             }else{
                ?>
                <h3 id='ribbon' class='well well-sm'><center>Payments Made to  <?php echo $rows3['name']; ?> Apartment:</center></h3>
                <?php
    }?>
<div class='tabs'>      
        <?php 

            $sql3 = "SELECT * FROM property WHERE property_id = '$listID'";
            $run3 = mysqli_query($conn, $sql3);
            $rows3= mysqli_fetch_assoc($run3);
            $name = $rows3['name'];
            $shortCode = $rows3['shortCode'];


    
            $sql4 = "SELECT * FROM mpesa WHERE BusinessShortCode = '$shortCode' ORDER BY TransTime DESC";
            $run4 = mysqli_query($conn, $sql4);
            $count4 = mysqli_num_rows($run4);

    
            echo "
            
            <div class='pan5'>
            <table class='table table-stripped'>
            <tr>
            
                <th><font color='white'>Transaction ID</font></th>
                <th><font color='white'>Amount</font></th>
                <th><font color='white'>House Number</font></th>
                <th><font color='white'>Payer Phone Number</font></th>
                <th><font color='white'>Payer Name</font></th>
                <th><font color='white'>Date and Time</font></th>
                <th></th>
            
            </tr>
            
            ";
    
            if($count4>0){
                $bal = 0;
                while($rows4 = mysqli_fetch_assoc($run4)){ 
                    $no = $rows4['MSISDN'];
  
                    // Or we can write ltrim($str, $str[0]);
                    $no = ltrim($no, '254');

                    $time = $rows4['TransTime'];
                    $time= (string)$time;
                    $full = $time[0].$time[1].$time[2].$time[3]."-".$time[4].$time[5]."-".$time[6].$time[7]." ".$time[8].$time[9].":".$time[10].$time[11].":".$time[12].$time[13];

                    $bal = $bal + $rows4['TransAmount'];
                    echo "
                    <tr>
                    <td>$rows4[TransID]</td>
                    <td>$rows4[TransAmount]</td>
                    <td>$rows4[BillRefNumber]</td>
                    <td>0$no</td>
                    <td>$rows4[FirstName] $rows4[MiddleName] $rows4[LastName]</td>
                    <td>$full</td>
                    </tr>
                    ";
                    
             };
             
                echo "</table>";
                echo "<center><h3 style='background-color: gray; width: 50%; margin-left:45%;'>Total Paid:<font color='white' size='6'>".$bal;
                echo "</font></center></div>
                ";
            }else{
                echo "</table>";
                echo "<center><h4>No Payements Have been made to this apartment</h4><br></center>";
                echo "</div>
                ";

            }
        ?>


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


?>

<?php 


if(isset($_GET['list_id'])){
    $listID = $_GET['list_id'];
    $_SESSION['listID']=$listID; ?>
    <script>window.location="apartment.php"</script>
    <?php
}

?>
