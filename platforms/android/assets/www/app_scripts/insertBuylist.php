<?php
header('Access-Control-Allow-Origin: *'); //To ajax request from cross domains also

include('dbConnect.php');

$con = new mysqli("$DB_HOST","$DB_USER","$DB_PASS","$DB_NAME");

$name = $_POST['name'];
$telephone = $_POST['telephone'];
$quantity = $_POST['quantity'];
$remarks = $_POST['remarks'];
$selected_item = $_POST['selected_item'];
$email = $_POST['email'];
$type_taste = $_POST['type_taste'];
$date = date("d/m/Y");
$time = date("h:i:s");


$query = "INSERT INTO `of_temp_buylist` (`mail`, `item_name`, `current_contact`, `quantity`, `remark`, `date_of_add`, `time_of_add`) VALUES ('$email', '$selected_item', '$telephone', $quantity, '$remarks', '$date', '$time')";


if(mysqli_query($con,$query)) {
      $result['result'] = true;
} else {
      $result['result'] = mysqli_error($con);
}

echo json_encode($result);

mysqli_close($con);

?> 