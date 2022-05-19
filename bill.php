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
  <link rel="stylesheet" href="style13.css">

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
    <title>Billing</title>

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
                <h3 id='ribbon' class='well well-sm'><center>Bill Tenants in <?php echo $rows3['name']; ?> Apartment:</center></h3>
                <?php
    }?>
<div class='tabs'>      
   


        <?php 

        if(isset($_GET['edit_id'])){
            $tenant_id = $_GET['edit_id'];
            $sql5 = "SELECT * FROM tenants WHERE tenant_id = '$tenant_id' ";
            $run5 = mysqli_query($conn, $sql5);
            $rows5 = mysqli_fetch_assoc($run5);
            $hse = $rows5['house_number'];


            $sql9 = "SELECT * FROM houses WHERE number = '$hse' AND apartment ='$name'";
            $run9 = mysqli_query($conn, $sql9);
            $rows9 = mysqli_fetch_assoc($run9);


            ?>
             <div class='pan4'>
                 
             <h4 id='ribbon' class='well well-sm'><center><font color='black'>Bill Tenant:</font></center></h4>
                <form method='post' class='form-group' id='form2'>
                    <div class='pan411'>
                        <div class='pan41'>
                        <label>Name:</label>
                        <div style='color: white;'><?php echo "$rows5[name]";?></div>
                        <br>
                        <label>Phone Number:</label>
                        <div style='color: white;'><?php echo "$rows5[phone]";?></div>
                        <br>
                        <label>Email:</label>
                        <div style='color: white;'><?php echo "$rows5[email]";?></div>
                        <br>
                        <label>House Number:</label>
                        <div style='color: white;'><?php echo "$rows5[house_number]";?></div>
                        <br>
                        <label>Status:</label>
                        <div style='color: white;'><?php echo "$rows5[status]";?></div>
                        <br>
                        </div>

                        <div class='pan41'>
                        <label>Rent:</label>
                        <div style='color: white;'><?php echo "$rows9[rent]";?></div>
                        <br>
                        <label>Water Bill:</label>
                        <input type='text' name='water' class='form-control' required='yes'>
                        <br>
                        <label>Garbage Bill:</label>
                        <input type='text' name='garbage' class='form-control' required='yes'>
                        <br>
                        <label>Month and Year You are Billing For:</label>
                        <input type='month' name='year' class='form-control'  required='yes'>
                        <br>
                        <input type="hidden" value="<?php echo $_GET['edit_id'] ?>" name="edit_pid"></p>
                        </div>
                        <br>

                    </div>
                        <input type='submit' style='margin-left:35%;'name='bill' value='Bill Tenant' class='btn btn-danger'>
                </form>
            </div>          
            <?php
            if(isset($_POST['bill'])){
                $phone = $rows5['phone'];
                $house = $rows5['house_number'];
                $rent = $rows9['rent'];
                $water = mysqli_real_escape_string($conn,strip_tags($_POST['water']));
                $garbage = mysqli_real_escape_string($conn,strip_tags($_POST['garbage']));
                $month1 = mysqli_real_escape_string($conn,strip_tags($_POST['year']));

                $total = $garbage + $water + $rent;
            
                $edit_id = $_POST['edit_pid']; 
            $ins_sql = "INSERT INTO billing(phone, apartment, house, rent, water, garbage, month, shortCode) VALUES('$phone', '$name', '$house','$rent', '$water','$garbage','$month1','$shortcode')";
            
                $edit_sql = "UPDATE tenants SET last_billed_month='$month1' WHERE tenant_id ='$edit_id' ";
                mysqli_query($conn, $ins_sql);

                $time = $phone;

                $time = (string)$time;
                $number = '254'.$time[1].$time[2].$time[3].$time[4].$time[5].$time[6].$time[7].$time[8].$time[9];
                
                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.twilio.com/2010-04-01/Accounts/AC76dab6b4c5d122f9d1ed64c2f54d1053/Messages.json?',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'To=%2B254707357072&Body=Dear Tenant, Your rent bill for this month is Ksh.'.$rent.'. , water bill is Ksh.'.$water.' and Garbage bill is Ksh.'.$garbage.'. Your total bill is '.$total.'   - Elite Realtors&From=%2B19593002841',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic QUM3NmRhYjZiNGM1ZDEyMmY5ZDFlZDY0YzJmNTRkMTA1Mzo3MjNkZTExYzY1ZTVkNDcxODhmYmIxMDViMTgyM2VmMA==',
                    'Content-Type: application/x-www-form-urlencoded'
                ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                
                if(mysqli_query($conn, $edit_sql)){
                    ?>
                    <script>
                        window.alert("You have succesfully Billed");
                        //window.location="bill.php";
                    </script>
                    <?php
                }else{
                    ?>
                    <script>
                        window.alert("Server Error Try again");
                        //window.location="bill.php";
                    </script>
                    <?php
                }
            
            }
            


        }else if(isset($_GET['editBill_id'])){
            $bill_id = $_GET['editBill_id'];
            $sql5 = "SELECT * FROM billing WHERE bill_id = '$bill_id' ";
            $run5 = mysqli_query($conn, $sql5);
            $rows5 = mysqli_fetch_assoc($run5);
            $hse = $rows5['house'];


            $sql9 = "SELECT * FROM tenants WHERE house_number = '$hse' AND apartment ='$name'";
            $run9 = mysqli_query($conn, $sql9);
            $rows9 = mysqli_fetch_assoc($run9);


            ?>
             <div class='pan4'>
                 
             <h4 id='ribbon' class='well well-sm'><center><font color='black'>Edit Bill:</font></center></h4>
                <form method='post' class='form-group' id='form2'>
                    <div class='pan411'>
                        <div class='pan41'>
                        <label>Name:</label>
                        <div style='color: white;'><?php echo "$rows9[name]";?></div>
                        <br>
                        <label>Phone Number:</label>
                        <div style='color: white;'><?php echo "$rows9[phone]";?></div>
                        <br>
                        <label>Email:</label>
                        <div style='color: white;'><?php echo "$rows9[email]";?></div>
                        <br>
                        <label>House Number:</label>
                        <div style='color: white;'><?php echo "$rows9[house_number]";?></div>
                        <br>
                        <label>Status:</label>
                        <div style='color: white;'><?php echo "$rows9[status]";?></div>
                        <br>
                        </div>

                        <div class='pan41'>
                        <label>Rent:</label>
                        <div style='color: white;'><?php echo "$rows5[rent]";?></div>
                        <br>
                        <label>Water Bill:</label>
                        <input type='text' name='water' value='<?php echo "$rows5[water]"; ?>' class='form-control' required='yes'>
                        <br>
                        <label>Garbage Bill:</label>
                        <input type='text' name='garbage' value='<?php echo "$rows5[garbage]"; ?>' class='form-control' required='yes'>
                        <br>
                        <label>Month and Year You are Billing For:</label>
                        <input type='month' name='year' class='form-control' value='<?php echo "$rows5[month]"; ?>' required='yes'>
                        <br>
                        <input type="hidden" value="<?php echo $_GET['editBill_id'] ?>" name="edit_pid"></p>
                        </div>
                        <br>

                    </div>
                        <input type='submit' style='margin-left:35%;'name='billEdit' value='Edit Bill' class='btn btn-danger'>
                </form>
            </div>          
            <?php
            if(isset($_POST['billEdit'])){
                $phone = $rows9['phone'];
                $house = $rows9['house_number'];
                $rent = $rows5['rent'];
                $water = mysqli_real_escape_string($conn,strip_tags($_POST['water']));
                $garbage = mysqli_real_escape_string($conn,strip_tags($_POST['garbage']));
                $month1 = mysqli_real_escape_string($conn,strip_tags($_POST['year']));
                
                $total = $rent + $water + $garbage;

                $edit_id = $_POST['edit_pid']; 
            $ins_sql = "UPDATE billing SET rent = '$rent', water = '$water', garbage = '$garbage', month = '$month1' WHERE bill_id = '$edit_id'";

            $edit_sql = "UPDATE tenants SET last_billing_month = '$month1' WHERE phone = '$phone' AND house_number = '$house'";
                mysqli_query($conn, $edit_sql);

                $time = $phone;

                $time = (string)$time;
                $number = '254'.$time[1].$time[2].$time[3].$time[4].$time[5].$time[6].$time[7].$time[8].$time[9];
                
                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.twilio.com/2010-04-01/Accounts/AC76dab6b4c5d122f9d1ed64c2f54d1053/Messages.json?',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'To=%2B'.$number.'&Body=Dear Tenant, Your monthly bill for '.$month1.' has been corrected, Rent is Ksh.'.$rent.' , water bill is Ksh.'.$water.' and Garbage bill is Ksh.'.$garbage.'. Your total bill is '.$total.'   - Elite Realtors&From=%2B18646252846',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic QUM3NmRhYjZiNGM1ZDEyMmY5ZDFlZDY0YzJmNTRkMTA1Mzo3MjNkZTExYzY1ZTVkNDcxODhmYmIxMDViMTgyM2VmMA==',
                    'Content-Type: application/x-www-form-urlencoded'
                ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                
                if(mysqli_query($conn, $ins_sql)){
                    ?>
                    <script>
                        window.alert("You have succesfully Edited the Bill");
                        window.location="bill.php";
                    </script>
                    <?php
                }else{
                    ?>
                    <script>
                        window.alert("Server Error Try again");
                        window.location="bill.php";
                    </script>
                    <?php
                }
            
            }
            
        }else{

            $sql3 = "SELECT * FROM property WHERE property_id = '$listID'";
            $run3 = mysqli_query($conn, $sql3);
            $rows3= mysqli_fetch_assoc($run3);
            $name = $rows3['name'];

            $curr_month = "20".date('y-m');


    
            $sql4 = "SELECT * FROM tenants WHERE apartment = '$name' AND status = 'Residing' AND last_billed_month <> '$curr_month' ORDER BY status DESC";
            $run4 = mysqli_query($conn, $sql4);
            $count4 = mysqli_num_rows($run4);

    
            echo "
            <div class='pan22'>
            <table class='table table-stripped'>
            <tr>
            
                <th><font color='white'>Name</font></th>
                <th><font color='white'>Phone</font></th>
                <th><font color='white'>Email</font></th>
                <th><font color='white'>House Number</font></th>
                <th><font color='white'>Last Billed Year and Month:</font></th>
                <th><font color='white'>Status</font></th>
                <th></th>
            
            </tr>
            
            ";
    
            if($count4>0){
                while($rows4 = mysqli_fetch_assoc($run4)){
                    $stat = $rows4['status'];
                    if($stat == 'Residing'){
                        $stat1 = "<div style='background-color: green; padding: 2px; color: white;'>Residing</div>";
                    }else if($stat == 'Moved'){
                        $stat1 = "<div style='background-color: red; padding: 2px; color: white;'>Moved</div>";
                    }else{
                        $stat1 = "";
                    }

                    echo "
                    <tr>
                    <td>$rows4[name]</td>
                    <td>$rows4[phone]</td>
                    <td>$rows4[email]</td>
                    <td>$rows4[house_number]</td>
                    <td>$rows4[last_billed_month]</td>
                    <td>$stat1</td>
                    <td><a href='bill.php?edit_id=$rows4[tenant_id]' style='color: white;'class='btn btn-danger'>Bill</a></td>
                    </tr>
                    ";
                    
                };
                echo "</table>";
                echo "</div>
                ";
            }else{
                echo "</table>";
                echo "<center><h4>You have billed all tenants for this month</h4><br></center>";
                echo "</div>
                ";

            }
           ?>
           <div class='pan32'>
               <?php 
               $sql3 = "SELECT * FROM property WHERE property_id = '$listID'";
                $run3 = mysqli_query($conn, $sql3);
                $rows3= mysqli_fetch_assoc($run3);
                $name = $rows3['name'];

                $sql7 = "SELECT * FROM billing WHERE apartment = '$name' ";
                $run7 = mysqli_query($conn,$sql7);
                
                $count7 = mysqli_num_rows($run7);


                echo "
                <div class='well well-sm'><center><h4><font color='black'>Billings Made to this Apartment:</font></h4></center></div>
            <table class='table table-stripped'>
            <tr>
                <th><font color='white'>House Number</font></th>
                <th><font color='white'>Tenant Phone Number</font></th>
                <th><font color='white'>Month Billed</font></th>
                <th><font color='white'>Rent</font></th>
                <th><font color='white'>Water</font></th>
                <th><font color='white'>Garbage</font></th>
                <th><font color='white'>Date/Time Billed</font></th>
                <th></th>
            </tr>
            
            ";


                if($count7>0){
                    while($rows7 = mysqli_fetch_assoc($run7)){
                        echo "
                        <tr>
                        <td>$rows7[house]</td>
                        <td>$rows7[phone]</td>
                        <td>$rows7[month]</td>
                        <td>$rows7[rent]</td>
                        <td>$rows7[water]</td>
                        <td>$rows7[garbage]</td>
                        <td>$rows7[time]</td>
                        <td><a href='bill.php?editBill_id=$rows7[bill_id]' style='color: white;'class='btn btn-primary'>Edit</a></td>
                        <td><a href='bill.php?delete_id=$rows7[bill_id]' style='color: white;'class='btn btn-danger'>Delete</a></td>
                        </tr>
                        ";
                        
                    };
                    echo "</table>";
                    echo "</div>";
                }else{
                    echo "</table>";
                    echo "<center><h4>You have not billed any tenants in this apartment</h4><br></center>";
                    echo "</div> ";
    
                }


               ?>
           </div>
           <?php 
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
<?php 
if(isset($_GET['delete_id'])){
    $delete_id = $_GET['delete_id'];

    $sql5 = "SELECT * FROM billing WHERE bill_id = '$delete_id' ";
            $run5 = mysqli_query($conn, $sql5);
            $rows5 = mysqli_fetch_assoc($run5);
            $hse = $rows5['house'];


            $sql9 = "SELECT * FROM tenants WHERE house_number = '$hse' AND apartment ='$name'";
            $run9 = mysqli_query($conn, $sql9);
            $rows9 = mysqli_fetch_assoc($run9);


            $edit_id = $rows9['tenant_id'];

            $time = $rows9['last_billed_month'];
            $time= (string)$time;

            $new = $time[5].$time[6];


            $newmonth = $new - 1;

            $newyear = $time[0].$time[1].$time[2].$time[3]."-".$newmonth;

            $edit_sql = "UPDATE tenants SET last_billed_month='$newyear' WHERE tenant_id ='$edit_id' ";
            mysqli_query($conn, $edit_sql);



    $del_sql = "DELETE FROM billing WHERE bill_id = '$_GET[delete_id]'";
    if(mysqli_query($conn, $del_sql)){
        ?>
        <script>alert("Deleted"); window.location="bill.php";</script>
        <?php
    }else{
        ?>
        <script>alert("Server Error"); window.location="bill.php";</script>
        <?php 
    }
}


?>