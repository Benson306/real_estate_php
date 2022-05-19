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
    <?php
    if(isset($_GET['edit_id'])){
             }else{
                ?>
                <h3 id='ribbon' class='well well-sm'><center>List of Units in <?php echo $rows3['name']; ?> Apartment:</center></h3>
                <?php
    }?>
<div class='tabs'>      
    <div class='pan1'>


        <?php 

        if(isset($_GET['edit_id'])){
            $house_id = $_GET['edit_id'];
            $sql5 = "SELECT * FROM houses WHERE house_id = '$house_id' ";
            $run5 = mysqli_query($conn, $sql5);
            $rows5 = mysqli_fetch_assoc($run5)

            ?>
            <h4 id='ribbon' class='well well-sm'><center><font color='black'>Edit House Details:</font></center></h4>
            <form method='post' class='form-group' id='form'>
                <label>House Number:</label>
                <input type='text' name='house' class='form-control' required='yes' value='<?php echo $rows5['number'];?>'>
                <br>
                <label>Type of House:</label>
                <select class='form-control' required='yes' name='type'>
                    <option value='<?php echo $rows5['type'];?>'><?php echo $rows5['type'];?></option>
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
                <select name='name' class='form-control' required='yes' >
                    <option value='<?php echo $rows5['apartment'];?>'><?php echo $rows5['apartment'];?> Apartment</option>
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
                    <option value='<?php echo $rows5['status'];?>'><?php echo $rows5['status'];?></option>
                    <option value="Occupied">Occupied</option>
                    <option value="Vacant">Vacant</option>
                </select>
                <br>
                <label>Rent (Ksh.)</label>
                <input type='number' name='rent' class='form-control' required='yes' value='<?php echo $rows5['rent'];?>'>
                <br>
                <input type="hidden" value="<?php echo $_GET['edit_id'] ?>" name="edit_pid"></p>
                <input type='submit' name='edit' value='Edit House' class='btn btn-danger'>
            </form>
            
            <?php
        }else{
            $sql3 = "SELECT * FROM property WHERE property_id = '$listID'";
            $run3 = mysqli_query($conn, $sql3);
            $rows3= mysqli_fetch_assoc($run3);
            $name = $rows3['name'];
    
            $sql4 = "SELECT * FROM houses WHERE apartment = '$name'";
            $run4 = mysqli_query($conn, $sql4);
            $count4 = mysqli_num_rows($run4);
    
            echo "
            <table class='table table-stripped'>
            <tr>
            
                <th><font color='white'>House Number</font></th>
                <th><font color='white'>House Type</font></th>
                <th><font color='white'>Rent</font></th>
                <th><font color='white'>Status</font></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            
            </tr>
            
            ";
    
            if($count4>0){
                while($rows4 = mysqli_fetch_assoc($run4)){
                    echo "
                    <tr>
                    <td>$rows4[number]</td>
                    <td>$rows4[type]</td>
                    <td>$rows4[rent]</td>
                    
                    ";
                    if($rows4['status'] == 'Vacant'){
                        echo "
                    <td><div style='background-color: red; color: white;'>$rows4[status]</div></td>
                    ";
                    }else{
                        echo "
                    <td><div style='background-color: green; color: white;'>$rows4[status]</div></td>
        
                    ";
                    }
        
                    echo "
                    <td></td>
                    <td></td>
                    <td><a href='apartment.php?edit_id=$rows4[house_id]' class='btn btn-primary'>Change Status</a></td>
                    <td><a href='apartment.php?delete_id=$rows4[house_id]' class='btn btn-danger'>Delete Unit</a></td>
                    </tr>
                    ";
                    
                };
                echo "</table>";
            }else{
                echo "</table>";
                echo "<center><h4>You have no houses listed under this property</h4><br></center>";
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

<?php 
if(isset($_GET['delete_id'])){

    $del_sql = "DELETE FROM houses WHERE house_id = '$_GET[delete_id]'";
    if(mysqli_query($conn, $del_sql)){
        ?>
        <script>
        window.alert("Deleted"); 
        window.location="apartment.php";
        </script>
        <?php
    }else{
        ?>
        <script>
        window.alert("Server Error"); 
        window.location="apartment.php";
        </script>
        <?php 
    }
}


?>

<?php 
if(isset($_POST['edit'])){
    $house = mysqli_real_escape_string($conn,strip_tags($_POST['house']));
    $type = mysqli_real_escape_string($conn,strip_tags($_POST['type']));
    $name = mysqli_real_escape_string($conn,strip_tags($_POST['name']));
    $status = mysqli_real_escape_string($conn,strip_tags($_POST['status']));
    $rent = mysqli_real_escape_string($conn,strip_tags($_POST['rent']));

    $edit_id = $_POST['edit_pid']; 

    $edit_sql = "UPDATE houses SET number = '$house', type='$type', apartment='$name',rent = '$rent', status = '$status' WHERE house_id ='$edit_id' ";

    if(mysqli_query($conn, $edit_sql)){
        ?>
        <script>
            window.alert("You have succesfully Edited house details");
            window.location="apartment.php";
        </script>
        <?php
    }else{
        ?>
        <script>
            window.alert("Server Error Try again");
            window.location="apartment.php";
        </script>
        <?php
    }


}

?>