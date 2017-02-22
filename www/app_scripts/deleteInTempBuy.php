<?php
header('Access-Control-Allow-Origin: *'); //To ajax request from cross domains also

include('dbConnect.php');

$con = new mysqli("$DB_HOST","$DB_USER","$DB_PASS","$DB_NAME");

$buy_id = $_POST['buy_id'];


$query = "delete from of_temp_buylist where of_temp_buylist.buy_id = $buy_id";


if(mysqli_query($con,$query)) {
      $result['result'] = true;
} else {
      $result['result'] = mysqli_error($con);
}

echo json_encode($result);

mysqli_close($con);

?> 