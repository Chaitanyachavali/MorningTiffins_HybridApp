<?php
header('Access-Control-Allow-Origin: *'); //To ajax request from cross domains also

include('dbConnect.php');

$con = new mysqli("$DB_HOST","$DB_USER","$DB_PASS","$DB_NAME");


$query = "select * from of_items where of_items.category = 'continential'"; 

$result = mysqli_query($con, $query);

$result_array = array();

if(mysqli_num_rows($result)){
	while($row=mysqli_fetch_assoc($result)){
		$result_array[]=$row;
	}
}

echo json_encode($result_array); 


mysqli_close($con);

?> 

