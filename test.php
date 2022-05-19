<?php
require("connection.php");

$sql5 = "SELECT * FROM test WHERE role = 'admin' ";
                    $run5 = mysqli_query($conn,$sql5);
                    $rows5 = mysqli_fetch_assoc($run5);
                    while($rows5=mysqli_fetch_assoc($run5)){
                        echo $rows5['user']."-".$rows5['role']."<br>";
                    };


                    $sql3 = 'SELECT * FROM test WHERE role = "user"';
                    $run3 = mysqli_query($conn,$sql3);

                    while( $rows3=mysqli_fetch_assoc($run3) ){
                        echo $rows3['user']."-".$rows3['role']."<br>";
                    };

/*

    $date = '20'.date('ymdhis');
    echo $date;
    echo "<br>";
    $date = '20'.date('ymdhis');
    $date= (string)$date;

    $newdate1 = $date[8].$date[9];

    $newdate2 = $newdate1 + 2;

    if($newdate2<10){
        $newdate2 = '0'.$newdate2;
    }

    $finalDate = $date[0].$date[1].$date[2].$date[3].$date[4].$date[5].$date[6].$date[7].$newdate2.$date[10].$date[11].$date[12].$date[13];

    echo $finalDate;*/