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
  <link rel="stylesheet" href="style2.css">
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
    <title>Properties</title>

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
    <h3 id='ribbon' class='well well-sm'><center>Apartments That you manage:</center></h3>
    <br>
<div class='tabs'>


    <div class='panel1'>
    <h4 id='ribbon' class='well well-sm'><center><font color='black'>Details of Properties that you manage:</font></center></h4>
        <?php 
        $sql = "SELECT * FROM property";
        $run = mysqli_query($conn, $sql);
        while($rows= mysqli_fetch_assoc($run)){
            echo "<div class='panel4'>";
            echo "<br>";
                        echo "<div class='well well-sm' style='width: 30%; margin-left:35%;';><center><font color='black'>".$rows['name']." Apartment";
                    echo "<br></font></center></div>";

            echo "<div class='panel2'>";

                echo "<div class='panel3'>";
                    echo "<font color='white'>Location:</font><br>";
                    echo "<font size='4'>$rows[location]</font>";
                    echo "<br>";
                    echo "<font color='white'>Number of Units:</font><br>";
                    echo "<font size='4'>$rows[units]</font>";
                echo "</div>";

                echo "<div class='panel3'>";
                    echo "<font color='white'>Name of the Owner:</font><br>";
                    echo "<font size='4'>$rows[owners_name]</font>";
                    echo "<br>";
                    echo "<font color='white'>Owners Number:</font><br>";
                    echo "<font size='4'>$rows[owners_number]</font>";
                    echo "<br>";
                    echo "<font color='white'>Business Short Code(Till / Paybill Number):</font><br>";
                    echo "<font size='4'>$rows[shortCode]</font>";
                echo "</div>";

            echo "</div>";
            echo "<div class='buttons'>";
                        echo "<div class='buttons1'>";
                            echo "<a href='properties.php?edit_id=$rows[property_id]' class='btn btn-primary'>Edit</a>";
                        echo "</div>";
                        echo "<div class='buttons1'>";
                            echo "<a href='properties.php?delete_id=$rows[property_id]' class='btn btn-danger'>Delete</a>";
                        echo "</div>";
            echo "</div>";
            echo "<br>";
            echo "</div>";
        };


        ?>
    </div>

    <?php 
	if (isset($_GET['edit_id']) ) { 
		$sql = "SELECT * FROM property WHERE property_id = '$_GET[edit_id]' ";
		$run = mysqli_query($conn, $sql);
		while( $rows= mysqli_fetch_assoc($run) ) {
			$name = $rows['name'];
			$location = $rows['location'];
			$units = $rows['units'];
            $owner = $rows['owners_name'];
            $number = $rows['owners_number'];
            $short_code = $rows['shortCode'];
		}
		?>
        <div class='panel1'>
     <h4 id='ribbon' class='well well-sm'><center><font color='black'>Edit Property Details:</font></center></h4>
            <form method='post' class='form-group'>
                <label>Apartment Name:</label>
                <input type='text' name='name' class='form-control' required='yes' value='<?php echo $name; ?>'>
                <br>
                <label>Location:</label>
                <input type='text' name='location' class='form-control' required='yes' value='<?php echo $location; ?>'>
                <br>
                <label>Number of units</label>
                <input type='text' name='units' class='form-control' required='yes' value='<?php echo $units; ?>'>
                <br>
                <label>Business Short Code(Till / Paybill Number)</label>
                <input type='number' name='shortcode' class='form-control' required='yes'  value='<?php echo $short_code; ?>'>
                <br>
                <label>Owner's Name:</label>
                <input type='text' name='owner' class='form-control' required='yes' value='<?php echo $owner; ?>'>
                <br>
                <label>Owner's Number:</label>
                <input type='text' name='owner_number' class='form-control' required='yes' value='<?php echo $number; ?>'>
                <br>
                <input type="hidden" value="<?php echo $_GET['edit_id'] ?>" name="edit_pid"></p>
                <input type='submit' name='edit' value='Edit Apartment' class='btn btn-danger'>
            </form>
    </div>
<?php }else{

    ?>
    <div class='panel1'>
     <h4 id='ribbon' class='well well-sm'><center><font color='black'>Add a Property:</font></center></h4>
            <form method='post' class='form-group'>
                <label>Apartment Name:</label>
                <input type='text' name='name' class='form-control' required='yes' placeholder='Apartment Name'>
                <br>
                <label>Location:</label>
                <input type='text' name='location' class='form-control' required='yes' placeholder='Location'>
                <br>
                <label>Number of units</label>
                <input type='number' name='units' class='form-control' required='yes' placeholder='Houses in the apartment'>
                <br>
                <label>Business Short Code(Till / Paybill Number)</label>
                <input type='number' name='shortcode' class='form-control' required='yes' placeholder='MPESA PAYBILL/TILL NUMBER'>
                <br>
                <label>Owner's Name:</label>
                <input type='text' name='owner' class='form-control' required='yes' placeholder="Owner's Name">
                <br>
                <label>Owner's Number:</label>
                <input type='text' name='owner_number' class='form-control' required='yes' placeholder="Owner's Number">
                <br>
                <input type='submit' name='add' value='Add Apartment' class='btn btn-success'>
            </form>
    </div>
    <?php
}
?>

    
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
if(isset($_POST['add'])){
    $name = mysqli_real_escape_string($conn,strip_tags($_POST['name']));
    $location = mysqli_real_escape_string($conn,strip_tags($_POST['location']));
    $units = mysqli_real_escape_string($conn,strip_tags($_POST['units']));
    $owner = mysqli_real_escape_string($conn,strip_tags($_POST['owner']));
    $number = mysqli_real_escape_string($conn,strip_tags($_POST['owner_number']));
    $shortcode = mysqli_real_escape_string($conn,strip_tags($_POST['shortcode']));

    $sql = "INSERT INTO property(name, location, units, owners_name, owners_number, shortCode) VALUES('$name','$location','$units','$owner','$number','$shortcode')";

    if(mysqli_query($conn, $sql)){
        ?>
        <script>
            window.alert("You have succesfully added an apartment");
            window.location="properties.php";
        </script>
        <?php
    }else{
        ?>
        <script>
            window.alert("Server Error Try again");
            window.location="properties.php";
        </script>
        <?php
    }
}



?>

<?php 
if(isset($_GET['delete_id'])){

    $del_sql = "DELETE FROM property WHERE property_id = '$_GET[delete_id]'";
    if(mysqli_query($conn, $del_sql)){
        ?>
        <script>alert("Deleted"); window.location="properties.php";</script>
        <?php
    }else{
        ?>
        <script>alert("Server Error"); window.location="properties.php";</script>
        <?php 
    }
}


?>

<?php 
if (isset($_POST['edit'] ) ){

    $name = mysqli_real_escape_string($conn,strip_tags($_POST['name']));
    $location = mysqli_real_escape_string($conn,strip_tags($_POST['location']));
    $units = mysqli_real_escape_string($conn,strip_tags($_POST['units']));
    $owner = mysqli_real_escape_string($conn,strip_tags($_POST['owner']));
    $number = mysqli_real_escape_string($conn,strip_tags($_POST['owner_number']));
    $shortcode = mysqli_real_escape_string($conn,strip_tags($_POST['shortcode']));

  $edit_id = $_POST['edit_pid']; 

  $edit_sql = "UPDATE property SET name = '$name', location= '$location', units='$units', owners_name='$owner', owners_number='$number', shortCode = '$shortcode'  WHERE property_id ='$edit_id' ";


   if(mysqli_query($conn,$edit_sql) ) { ?>
    <script>
    window.alert("You have succesfully Edited");
    window.location="properties.php";
    </script>
   <?php } else { ?>
   <script >
   window.alert("Server Error. Retry");
   window.location="property.php";
   </script>
   <?php }
}

?>