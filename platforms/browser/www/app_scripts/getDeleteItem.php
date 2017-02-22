<?php
header('Access-Control-Allow-Origin: *'); //To ajax request from cross domains also

include('dbConnect.php');

$con = new mysqli("$DB_HOST","$DB_USER","$DB_PASS","$DB_NAME");

$email = $_POST['email'];
$buy_id = $_POST['buy_id'];


$query = "select * from of_temp_buylist left outer join of_items on of_temp_buylist.item_name = of_items.name where of_temp_buylist.mail = '$email' and buy_id = $buy_id"; 

$output = mysqli_query($con, $query);

$row = mysqli_fetch_array($output);
	echo json_encode($row);



mysqli_close($con);

?> 