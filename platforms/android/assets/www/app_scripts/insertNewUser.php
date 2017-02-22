<?php
header('Access-Control-Allow-Origin: *'); //To ajax request from cross domains also

include('dbConnect.php');

$con = new mysqli("$DB_HOST","$DB_USER","$DB_PASS","$DB_NAME");

$google_id = $_POST['google_id'];
$mail = $_POST['mail'];
$name = $_POST['name'];
$gender = $_POST['gender'];


$query = "INSERT INTO `of_users` (`mail`, `name`, `gender`, `google_id`) VALUES ('$mail', '$name', '$gender', '$google_id');";


if(mysqli_query($con,$query)) {
      $result['result'] = true;
} else {
      $result['result'] = mysqli_error($con);
}

echo json_encode($result);

mysqli_close($con);

?> 