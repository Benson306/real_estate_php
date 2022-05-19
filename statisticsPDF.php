<?php
session_start();
require('connection.php'); 
$listID = $_SESSION['listID'];
if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <link rel="stylesheet" href="style9.css">
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
    <title>Graphs</title>

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
    <h3 id='ribbon' class='well well-sm'><center>Balances Per Month:</center></h3>
      <br>
      <br>
    <div id='columnchart_values' style='margin-left:18%; width: 30%; height: 300px;'></div>

<?php
$sql3 = "SELECT * FROM property WHERE property_id = '$listID'";
            $run3 = mysqli_query($conn, $sql3);
            $rows3= mysqli_fetch_assoc($run3);
            $name = $rows3['name'];
            $shortcode = $rows3['shortCode'];


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
                GROUP BY monthMPESA
            ) AS payment
        ON billing.month=payment.monthMPESA 
        WHERE apartment = '$name'
        GROUP BY month";

            $run4 = mysqli_query($conn,$sql4);
            $date = date('d/m/y h:i:s');     
                
    ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart1);

      function drawChart1() {
      var data1 = google.visualization.arrayToDataTable([
        ["Element", "Balance not Paid", { role: "style" } ],
            <?php   
                while($rows4=mysqli_fetch_assoc($run4)){

                    $total = $rows4['allRent']+$rows4['allWater']+$rows4['allGarbage'];
                    $balance = $rows4['Amt']-$total;

                    if($balance<0){
                        $balance=$balance*-1;
                        echo"['$rows4[month]', ".$balance.", '#b87333'],";
                    }else{
                        echo"['$rows4[month]', 0, '#b87333'],";
                    }

                
                }; ?>
               
            ]);

            var view1 = new google.visualization.DataView(data1);
            view1.setColumns([0, 1,
                            { calc: "stringify",
                                sourceColumn: 1,
                                type: "string",
                                role: "annotation" },
                            2]);

            var options1 = {
                title: "Balances (x) Vs Month (y)",
                width: 893,
                height: 293,
                bar: {groupWidth: "75%"},
                legend: { position: "none" },
            };
            var chart1 = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
            chart1.draw(view1, options1);
        }
            
    </script> 

                
</html>
<?php }else{
?>
<script>window.alert("You have not Logged in");window.location="index.php";</script>
<?php
}
?>