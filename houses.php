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
  <link rel="stylesheet" href="style3.css">
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
    <h3 id='ribbon' class='well well-sm'><center>Manage Single Units in an apartment:</center></h3>
    <br>
    
<div class='tabs'>


    <div class='panel1'>
    <h4 id='ribbon' class='well well-sm'><center><font color='black'>View Units in Each Apartment:</font></center></h4>
        <?php 
        $sql = "SELECT * FROM property";
        $run = mysqli_query($conn, $sql);
        while($rows= mysqli_fetch_assoc($run)){
                            echo "<div class='houses'>";
                            echo "<a href='houses.php?list_id=$rows[property_id]' style='color: black;' class='btn btn-warning btn-block'>$rows[name] Apartment</a>";
                            echo "<br>";
                            echo "<br>";
                            echo "</div>";
        };


        ?>
    </div>
        
    <div class='panel1'>
     <h4 id='ribbon' class='well well-sm'><center><font color='black'>Add a House to an Apartment:</font></center></h4>
            <form method='post' class='form-group'>
                <label>House Number:</label>
                <input type='text' name='house' class='form-control' required='yes' placeholder='House Number e.g H3'>
                <br>
                <label>Type of House:</label>
                <select class='form-control' required='yes' name='type'>
                    <option></option>
                    <option value="Single room">Single room</option>
                    <option value="Double room">Double room</option>
                    <option value="Bedsitter">Bedsitter</option>
                    <option value="One Bedroom">One Bedroom</option>
                    <option value="Two Bedroom">Two Bedroom</option>
                    <option value="Three Bedroom">Three Bedroom</option>
                    <option value="Four Bedroom">Four Bedroom</option>
                </select>
                <br>
                <label>Apartment Name:</label>
                <select name='name' class='form-control' required='yes'>
                    <option></option>
                    <?php 
                        $sql1 = "SELECT * FROM property";
                        $run1 = mysqli_query($conn, $sql1);
                        while($rows1= mysqli_fetch_assoc($run1)){
                            echo "<option value='$rows1[name]'>$rows1[name] Apartment</option>";
                        }
                    ?>
                </select>
                <br>
                <label>Status</label>
                <select class='form-control' required='yes' name='status'>
                    <option></option>
                    <option value="Occupied">Occupied</option>
                    <option value="Vacant">Vacant</option>
                </select>
                <br>
                <label>Rent (Ksh.)</label>
                <input type='number' name='rent' class='form-control' required='yes' placeholder='Houses in the apartment'>
                <br>
                <input type='submit' name='add' value='Add House' class='btn btn-primary'>
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
if(isset($_POST['add'])){
    $house = mysqli_real_escape_string($conn,strip_tags($_POST['house']));
    $type = mysqli_real_escape_string($conn,strip_tags($_POST['type']));
    $name = mysqli_real_escape_string($conn,strip_tags($_POST['name']));
    $status = mysqli_real_escape_string($conn,strip_tags($_POST['status']));
    $rent = mysqli_real_escape_string($conn,strip_tags($_POST['rent']));

    $sql = "INSERT INTO houses(number, type, apartment, rent, status) VALUES('$house','$type','$name','$rent','$status')";

    if(mysqli_query($conn, $sql)){
        ?>
        <script>
            window.alert("You have succesfully added a house");
            window.location="houses.php";
        </script>
        <?php
    }else{
        ?>
        <script>
            window.alert("Server Error Try again");
            window.location="houses.php";
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
