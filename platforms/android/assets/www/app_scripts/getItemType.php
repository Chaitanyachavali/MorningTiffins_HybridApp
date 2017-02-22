<?php
header('Access-Control-Allow-Origin: *'); //To ajax request from cross domains also

include('dbConnect.php');

$con = new mysqli("$DB_HOST","$DB_USER","$DB_PASS","$DB_NAME");

$selected_item = $_POST['selected_item'];


$query = "select category from of_items where of_items.name = '$selected_item'"; 

$output = mysqli_query($con, $query);

$row = mysqli_fetch_array($output);
	echo json_encode($row);



mysqli_close($con);

?> 