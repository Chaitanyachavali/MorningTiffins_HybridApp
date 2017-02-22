<?php
header('Access-Control-Allow-Origin: *'); //To ajax request from cross domains also

include('dbConnect.php');

$con = new mysqli("$DB_HOST","$DB_USER","$DB_PASS","$DB_NAME");

$email = $_POST['email'];

$query = "select * from of_temp_buylist left outer join of_items on of_temp_buylist.item_name = of_items.name where of_temp_buylist.mail = '$email'"; 

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