<?php
include("connection.php");
if(isset($_GET["user_id"])) $user_id = $_GET["user_id"];
else die("Please log in");
$query = $mysqli->prepare("Select concat(first_name, ' ', last_name) as full_name, first_name, last_name, dob, gender, location from users where user_id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$user_details = $query->get_result();
$response = $user_details->fetch_assoc();
$json = json_encode($response);
echo $json;
?>