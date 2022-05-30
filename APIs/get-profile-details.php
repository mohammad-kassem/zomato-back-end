<?php
include("connection.php");
header('Access-Control-Allow-Origin: *');

$user_id = $_GET["user_id"];
$query = $mysqli->prepare("Select first_name, last_name, dob, gender, location from users where user_id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$user_details = $query->get_result();
$response = $user_details->fetch_assoc();
$json = json_encode($response);
echo $json;
?>