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
  <link rel="stylesheet" href="style5.css">
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
    <br>
    <br>
    
<div class='tabs'>


    <div class='panel6'>
    <h4 id='ribbon' class='well well-sm'><center><font color='black'>Users Of this System:</font></center></h4>
        <?php 
        $sql = "SELECT * FROM users";
        $run = mysqli_query($conn, $sql);
        echo "
        <table class='table table-stripped'>
        <tr>
            <th><font color='white'>Name</font></th>
            <th><font color='white'>Email</font></th>
            <th><font color='white'>Phone Number</font></th>
            <th><font color='white'>Role</font></th>
            <th><font color='white'>Password</font></th>
        </tr>
        ";
        while($rows= mysqli_fetch_assoc($run)){
              echo "
              <tr>
              <td>$rows[first_name] $rows[surname]</td>
              <td>$rows[email]</td>
              <td>$rows[phone]</td>
              <td>$rows[role]</td>
              <td>*****</td>
              <td><a href='users.php?edit_id=$rows[user_id]' class='btn btn-primary'>Edit</a></td>
              <td><a href='users.php?del_id=$rows[user_id]' class='btn btn-danger'>Delete</a></td>
              
              </tr>
              ";              
        };
        echo "</table>";

        ?>
    </div>
    <?php
        if(isset($_GET['edit_id'])){
            $edit = $_GET['edit_id'];
            $sql7 = "SELECT * FROM users WHERE user_id = '$edit'";
            $run7 = mysqli_query($conn, $sql7);
            $rows7= mysqli_fetch_assoc($run7);


            $sql10 = "SELECT * FROM users WHERE email = '$email'";
        $run10 = mysqli_query($conn, $sql10);
        $rows10= mysqli_fetch_assoc($run10);
        $role10 = $rows10['role'];
            ?>
            <div class='panel7'>
     <h4 id='ribbon' class='well well-sm'><center><font color='black'>Edit User Details:</font></center></h4>
            <form method='post' class='form-group'>
                <label>First Name:</label>
                <input type='text' name='first' class='form-control' required='yes' value='<?php echo "$rows7[first_name]"; ?>' placeholder='First Name'>
                <br>
                <label>Surname:</label>
                <input type='text' name='surname' class='form-control' required='yes' value='<?php echo "$rows7[surname]"; ?>' placeholder='Surname'>
                <br>
                <label>Email:</label>
                <input type='email' name='email' class='form-control' required='yes' value='<?php echo "$rows7[email]"; ?>' placeholder='Email'>
                <br>
                <label>Phone Number:</label>
                <input type='text' name='phone' class='form-control' required='yes' value='<?php echo "$rows7[phone]"; ?>' placeholder='07*******'>
                <br>
                <?php 
                if($role10=='admin'){
                ?>
                <label>Role:</label>
                <select class='form-control' required='yes' name='role'>
                    <option value='<?php echo "$rows7[role]"; ?>'><?php echo "$rows7[role]";?></option>
                    <option value="admin">admin</option>
                    <option value="user">user</option>
                </select>
                <br>
                <?php }else{ 
                    ?>
                <input type="hidden" value="user" required='yes' name="role"></p>  
                <?php
                    }
                ?>
                <label>Password</label>
                <input type='password' name='password' class='form-control' value='<?php echo "$rows7[password]"; ?>' required='yes' placeholder='Password'>
                <br>
                <input type="hidden" value="<?php echo $_GET['edit_id'] ?>" name="edit_pid"></p>
                <input type='submit' name='edit' value='Edit User Details' class='btn btn-danger'>
            </form>
        </div>
            
            <?
        }else{
            ?>
            <div class='panel7'>
     <h4 id='ribbon' class='well well-sm'><center><font color='black'>Add a new User:</font></center></h4>
            <form method='post' class='form-group'>
                <label>First Name:</label>
                <input type='text' name='first' class='form-control' required='yes' placeholder='First Name'>
                <br>
                <label>Surname:</label>
                <input type='text' name='surname' class='form-control' required='yes' placeholder='Surname'>
                <br>
                <label>Email:</label>
                <input type='email' name='email' class='form-control' required='yes' placeholder='Email'>
                <br>
                <label>Phone Number:</label>
                <input type='text' name='phone' class='form-control' required='yes' placeholder='07*******'>
                <br>
                <?php
                $sql10 = "SELECT * FROM users WHERE email = '$email'";
                $run10 = mysqli_query($conn, $sql10);
                $rows10= mysqli_fetch_assoc($run10);
                $role10 = $rows10['role']; 
                if($role10=='admin'){
                ?>
                <label>Role:</label>
                <select class='form-control' required='yes' name='role'>
                    <option></option>
                    <option value="admin">admin</option>
                    <option value="user">user</option>
                </select>
                <br>
                <?php }else{ 
                    ?>
                <input type="hidden" value="user" required='yes' name="role"></p>  
                <?php
                    }
                ?>
                <label>Password</label>
                <input type='password' name='password' class='form-control' required='yes' placeholder='Password'>
                <br>
                <input type='submit' name='add' value='Add User' class='btn btn-danger'>
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
if(isset($_GET['del_id'])){
    $sql8 = "SELECT * FROM users WHERE email = '$email'";
    $run8 = mysqli_query($conn, $sql8);
    $rows8= mysqli_fetch_assoc($run8);
    $role = $rows8['role'];

    if($role=='admin'){
        $del_sql = "DELETE FROM users WHERE user_id = '$_GET[del_id]'";
        if(mysqli_query($conn, $del_sql)){
            ?>
            <script>alert("Deleted"); window.location("users.php");</script>
            <?php
        }else{
            ?>
            <script>alert("Server Error"); window.location("users.php");</script>
            <?php 
        }
    }else{
        ?>
        <script>alert("You Are not admin");window.location="users.php";</script>
        <?php
    }

}
?>

<?php
    if(isset($_POST['edit'])){
        $sql8 = "SELECT * FROM users WHERE email = '$email'";
        $run8 = mysqli_query($conn, $sql8);
        $rows8= mysqli_fetch_assoc($run8);
        $role = $rows8['role'];

        $first = mysqli_real_escape_string($conn,strip_tags($_POST['first']));
        $surname = mysqli_real_escape_string($conn,strip_tags($_POST['surname']));
        $email2 = mysqli_real_escape_string($conn,strip_tags($_POST['email']));
        $phone = mysqli_real_escape_string($conn,strip_tags($_POST['phone']));
        $role1 = mysqli_real_escape_string($conn,strip_tags($_POST['role']));
        $password = mysqli_real_escape_string($conn,strip_tags($_POST['password']));

        $edit_id = $_POST['edit_pid']; 

    $edit_sql = "UPDATE users SET email='$email2', first_name='$first', surname= '$surname', phone ='$phone', role ='$role1', password ='$password' WHERE user_id ='$edit_id' ";

    if($role == 'admin' || $email == $email2){

            if(mysqli_query($conn, $edit_sql)){
                ?>
                <script>
                    window.alert("You have succesfully Edited User Details");
                    window.location="users.php";
                </script>
                <?php
            }else{
                ?>
                <script>
                    window.alert("Server Error Try again");
                    window.location="users.php";
                </script>
                <?php
            }
    
    }else{
        ?>
        <script>window.alert("You Are not admin. You are only able to modify your own details");window.location="users.php";</script>
        <?php
    }
}

?>

<?php
    if(isset($_POST['add'])){
        $sql8 = "SELECT * FROM users WHERE email = '$email'";
        $run8 = mysqli_query($conn, $sql8);
        $rows8= mysqli_fetch_assoc($run8);
        $role = $rows8['role'];

        $first = mysqli_real_escape_string($conn,strip_tags($_POST['first']));
        $surname = mysqli_real_escape_string($conn,strip_tags($_POST['surname']));
        $email2 = mysqli_real_escape_string($conn,strip_tags($_POST['email']));
        $phone = mysqli_real_escape_string($conn,strip_tags($_POST['phone']));
        $role1 = mysqli_real_escape_string($conn,strip_tags($_POST['role']));
        $password = mysqli_real_escape_string($conn,strip_tags($_POST['password']));

    $ins_sql = "INSERT INTO users(email, first_name, surname, phone, role, password) VALUES('$email2', '$first', '$surname', '$phone', '$role1', '$password')";


    if($role == 'admin'){

            if(mysqli_query($conn, $ins_sql)){
                ?>
                <script>
                    window.alert("You have succesfully Added a User");
                    window.location="users.php";
                </script>
                <?php
            }else{
                ?>
                <script>
                    window.alert("Server Error Try again");
                   window.location="users.php";
                </script>
                <?php
            }
    
    }else{
        ?>
        <script>window.alert("You Are not admin. You cannot add new users");window.location="users.php";</script>
        <?php
    }
}

?>

