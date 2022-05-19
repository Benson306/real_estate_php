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
    <?php
    if(isset($_GET['edit_id'])){
             }else{
                ?>
                <h3 id='ribbon' class='well well-sm'><center>Select The Unit To Get Statement:</center></h3>
                <?php
    }?>
<div class='tabs'>      
   


        <?php 


            $sql3 = "SELECT * FROM property WHERE property_id = '$listID'";
            $run3 = mysqli_query($conn, $sql3);
            $rows3= mysqli_fetch_assoc($run3);
            $name = $rows3['name'];
            $shortcode = $rows3['shortCode'];

            $sql6 = "SELECT * FROM mpesa WHERE BusinessShortCode = '$shortcode' GROUP BY BillRefNumber";
            $run6 = mysqli_query($conn, $sql6);
            $count6 = mysqli_num_rows($run6);


            $sql4="SELECT
                                    *,SUM(rent) AS allRent, SUM(water) AS allWater, SUM(garbage) as allGarbage 
                                FROM
                                    billing 
                                    JOIN(
                                            SELECT
                                                *, SUM(TransAmount) as Amt
                                            FROM
                                                mpesa
                                            WHERE BusinessShortCode = '$shortcode'
                                            GROUP BY BillRefNumber
                                        ) AS payment
                                    ON billing.house=payment.BillRefNumber
                                    WHERE apartment = '$name'
                                   GROUP BY house";


            //$sql4 = "SELECT *,SUM(rent) AS allRent, SUM(water) AS allWater, SUM(garbage) as allGarbage FROM billing WHERE apartment = '$name' GROUP BY house";
            $run4 = mysqli_query($conn, $sql4);
            $count4 = mysqli_num_rows($run4);


            echo "
            <div class='pan5'>
            <table class='table table-stripped'>
            <tr>
            
                <th><font color='white'>House Number</font></th>
                <th><font color='white'>Phone</font></th>
                <th><font color='white'>rent</font></th>
                <th><font color='white'>water</font></th>
                <th><font color='white'>Garbage</font></th>
                <th><font color='white'>Total Billed</font></th>
                <th><font color='white'>Total Paid</font></th>
                <th><font color='white'>Balance</font></th>
                <th></th>
            
            </tr>
            
            ";
            
            
            if($count4>0){
                while($rows4 = mysqli_fetch_assoc($run4)){
                    
                    $total = $rows4['allRent']+$rows4['allWater']+$rows4['allGarbage'];
                    $balance = $rows4['Amt']-$total;
                  echo "
                    <tr>
                    <td>$rows4[house]</td>
                    <td>$rows4[phone]</td>
                    <td>$rows4[allRent]</td>
                    <td>$rows4[allWater]</td>
                    <td>$rows4[allGarbage]</td>
                    <td>$total</td>
                    <td>$rows4[Amt]</td>
                    <td>$balance</td>
                    
                    <td><a href='bal.php?edit_id=$rows4[bill_id]' style='color: white;'class='btn btn-danger'>Print Statement</a></td>
                    </tr>
                    ";
                    if(isset($_GET['edit_id'])){
                        $edit = $_GET['edit_id'];
                        $sql1 = "SELECT * FROM billing WHERE bill_id = '$edit' ";
                        $run1 = mysqli_query($conn, $sql1);
                        $rows1 = mysqli_fetch_assoc($run1);

                        $_SESSION['house']=$rows1['house'];
                        $_SESSION['phone']=$rows1['phone'];

                        $house = $rows1['house'];

                        $sql8="SELECT
                        *,SUM(rent) AS allRent, SUM(water) AS allWater, SUM(garbage) as allGarbage 
                    FROM
                        billing 
                        JOIN(
                                SELECT
                                    *, SUM(TransAmount) as Amt
                                FROM
                                    mpesa
                                WHERE BusinessShortCode = '$shortcode'
                                GROUP BY BillRefNumber
                            ) AS payment
                        ON billing.house=payment.BillRefNumber
                        WHERE bill_id = '$edit'";


                        $sql9="SELECT
                        *,SUM(rent) AS allRent, SUM(water) AS allWater, SUM(garbage) as allGarbage 
                        FROM
                        billing 
                        JOIN(
                                SELECT
                                    *, SUM(TransAmount) as Amt
                                FROM
                                    mpesa
                                WHERE BusinessShortCode = '$shortcode'
                                GROUP BY BillRefNumber
                            ) AS payment
                        ON billing.house=payment.BillRefNumber
                        WHERE apartment = '$name' AND house = '$house'
                        GROUP BY house";

                        $run9 = mysqli_query($conn, $sql9);

                        $newtotal =0;
                        while($rows9 = mysqli_fetch_assoc($run9)){              
                            $newtotal = $rows9['allRent']+$rows9['allWater']+$rows9['allGarbage']; 
                        }

                        $run8 = mysqli_query($conn, $sql8);
                        $rows8 = mysqli_fetch_assoc($run8);
                        
                        $newbalance = $rows8['Amt']-$newtotal;

                        $_SESSION['billed']=$newtotal;
                        $_SESSION['paid']=$rows8['Amt'];
                        $_SESSION['balance']=$newbalance;

                       ?> <script>window.location="pdf.php"</script><?php
                    }
                       
                };
                
                echo "</table>";
                echo "</div>
                ";
            }else{
                echo "</table>";
                echo "<center><h4>No billing or payment has been recorded for this apartment</h4><br></center>";
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


