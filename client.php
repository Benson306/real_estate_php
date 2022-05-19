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
  <link rel="stylesheet" href="style6.css">
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
    <title>Tenants</title>

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
                <h3 id='ribbon' class='well well-sm'><center>List of Tenants in <?php echo $rows3['name']; ?> Apartment:</center></h3>
                <?php
    }?>
<div class='tabs'>      
   


        <?php 

        if(isset($_GET['edit_id'])){
            $tenant_id = $_GET['edit_id'];
            $sql5 = "SELECT * FROM tenants WHERE tenant_id = '$tenant_id' ";
            $run5 = mysqli_query($conn, $sql5);
            $rows5 = mysqli_fetch_assoc($run5)

            ?>
             <div class='pan4'>
             <h4 id='ribbon' class='well well-sm'><center><font color='black'>Edit Tenant Details:</font></center></h4>
                <form method='post' class='form-group' id='form'>
                    <label>Name:</label>
                    <input type='text' name='name' class='form-control' required='yes' value='<?php echo "$rows5[name]";?>'>
                    <br>
                    <label>Phone Number:</label>
                    <input type='text' name='phone' class='form-control' required='yes' value='<?php echo "$rows5[phone]";?>' >
                    <br>
                    <label>Email:</label>
                    <input type='email' name='email' class='form-control' value='<?php echo "$rows5[email]";?>'>
                    <br>
                    <label>House Number:</label>
                    <select name='house' class='form-control' required='yes' >
                        <option value='<?php echo "$rows5[house_number]";?>'><?php echo "$rows5[house_number]";?></option>
                        <?php 
                            $sql1 = "SELECT * FROM houses WHERE apartment = '$name'";
                            $run1 = mysqli_query($conn, $sql1);
                            while($rows1= mysqli_fetch_assoc($run1)){
                                echo "<option value='$rows1[number]'>$rows1[number]</option>";
                            }
                        ?>
                    </select>
                    <br>
                    <label>Status:</label>
                    <select name='status' class='form-control' required='yes' >
                        <option value="<?php echo "$rows5[status]";?>"><?php echo "$rows5[status]";?></option>
                        <option value="Residing">Residing</option>
                        <option value="Moved">Moved</option>
                    </select>
                    <br>
                    <label>Month and Year Tenant Moved In</label>
                    <input type='text' name='year' class='form-control' value='<?php echo "$rows5[year]";?>'>
                    <br>
                    <input type="hidden" value="<?php echo $_GET['edit_id'] ?>" name="edit_pid"></p>
                    <input type='submit' name='edit' value='Edit Tenant Details' class='btn btn-success'>
                </form>
            </div>          
            <?php
        }else{

            $sql3 = "SELECT * FROM property WHERE property_id = '$listID'";
            $run3 = mysqli_query($conn, $sql3);
            $rows3= mysqli_fetch_assoc($run3);
            $name = $rows3['name'];
    
            $sql4 = "SELECT * FROM tenants WHERE apartment = '$name' ORDER BY status DESC";
            $run4 = mysqli_query($conn, $sql4);
            $count4 = mysqli_num_rows($run4);
    
            echo "
            <div class='pan2'>
            <table class='table table-stripped'>
            <tr>
            
                <th><font color='white'>Name</font></th>
                <th><font color='white'>Phone</font></th>
                <th><font color='white'>Email</font></th>
                <th><font color='white'>House Number</font></th>
                <th><font color='white'>Moved In on:</font></th>
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
                    <td>$rows4[year]</td>
                    <td>$stat1</td>
                    <td><a href='client.php?edit_id=$rows4[tenant_id]' class='btn btn-primary'>Edit</a></td>
                    </tr>
                    ";
                    
                };
                echo "</table>";
                echo "</div>
                <div class='pan3'>
                ";
                add();
            }else{
                echo "</table>";
                echo "<center><h4>You have not registered any tenants in this apartment</h4><br></center>";
                echo "</div>
                <div class='pan3'>
                ";
                add();

            }
            
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

function add(){
    require("connection.php");
    $listID = $_SESSION['listID'];
    $sql3 = "SELECT * FROM property WHERE property_id = '$listID'";
        $run3 = mysqli_query($conn, $sql3);
        $rows3= mysqli_fetch_assoc($run3);
        $name = $rows3['name'];
    ?>
    <h4 id='ribbon' class='well well-sm'><center><font color='black'>Add Tenant Details:</font></center></h4>
<form method='post' class='form-group' id='form'>
    <label>Name:</label>
    <input type='text' name='name' class='form-control' required='yes' placeholder='John Doe'>
    <br>
    <label>Phone Number:</label>
    <input type='text' name='phone' class='form-control' required='yes' placeholder='07********' >
    <br>
    <label>Email:</label>
    <input type='email' name='email' class='form-control' placeholder='Email'>
    <br>
    <label>House Number:</label>
    <select name='house' class='form-control' required='yes' >
        <option></option>
        <?php 
            $sql1 = "SELECT * FROM houses WHERE apartment = '$name'";
            $run1 = mysqli_query($conn, $sql1);
            while($rows1= mysqli_fetch_assoc($run1)){
                echo "<option value='$rows1[number]'>$rows1[number]</option>";
            }
        ?>
    </select>
    <br>
    <label>Month and Year Tenant Moved In</label>
    <input type='month' name='year' class='form-control' placeholder='e.g January, 2020'>
    <br>
    <input type='submit' name='add_tenant' value='Register Tenant' class='btn btn-success'>
</form>
        </div>
    
    <?php
    echo "
    
    </div>
    ";
}


?>

<?php 
if(isset($_POST['add_tenant'])){

    require("connection.php");
    $listID = $_SESSION['listID'];
    $sql3 = "SELECT * FROM property WHERE property_id = '$listID'";
    $run3 = mysqli_query($conn, $sql3);
    $rows3= mysqli_fetch_assoc($run3);
    $name1 = $rows3['name'];

    $name = mysqli_real_escape_string($conn,strip_tags($_POST['name']));
    $phone = mysqli_real_escape_string($conn,strip_tags($_POST['phone']));
    $email = mysqli_real_escape_string($conn,strip_tags($_POST['email']));
    $house = mysqli_real_escape_string($conn,strip_tags($_POST['house']));
    $year = mysqli_real_escape_string($conn,strip_tags($_POST['year']));

    $apartment = $name1;

    $sql = "INSERT INTO tenants(name, phone, email, house_number, apartment, year, status, last_billed_month) VALUES('$name','$phone','$email','$house', '$apartment', '$year', 'Residing', '')";

    if(mysqli_query($conn, $sql)){
        ?>
        <script>
            window.alert("You have succesfully Registered a Tenant");
            window.location="client.php";
        </script>
        <?php
    }else{
        ?>
        <script>
            window.alert("Server Error Try again");
            //window.location="client.php";
        </script>
        <?php
    }
}

if(isset($_GET['list_id'])){
    $listID = $_GET['list_id'];
    $_SESSION['listID']=$listID; ?>
    <script>window.location="apartment.php"</script>
    <?php
}

?>
<?php 
if(isset($_POST['edit'])){
    $name = mysqli_real_escape_string($conn,strip_tags($_POST['name']));
    $phone = mysqli_real_escape_string($conn,strip_tags($_POST['phone']));
    $email = mysqli_real_escape_string($conn,strip_tags($_POST['email']));
    $house = mysqli_real_escape_string($conn,strip_tags($_POST['house']));
    $year = mysqli_real_escape_string($conn,strip_tags($_POST['year']));
    $status = mysqli_real_escape_string($conn,strip_tags($_POST['status']));

    $edit_id = $_POST['edit_pid']; 

    $edit_sql = "UPDATE tenants SET name = '$name', phone='$phone', email='$email',house_number = '$house', year = '$year', status= '$status' WHERE tenant_id ='$edit_id' ";

    if(mysqli_query($conn, $edit_sql)){
        ?>
        <script>
            window.alert("You have succesfully Edited house details");
            window.location="client.php";
        </script>
        <?php
    }else{
        ?>
        <script>
            window.alert("Server Error Try again");
            window.location="client.php";
        </script>
        <?php
    }


}

?>

