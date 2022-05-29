<?php
header('Access-Control-Allow-Origin: *');
  
include("connection.php");

$query = $mysqli->prepare("SELECT * FROM restaurants");
$query->execute();
$array = $query->get_result();
$response = [];
while($user = $array->fetch_assoc()){
    $response[] = $user;
} 

$json = json_encode($response);
echo $json;

?>

<!-- http://localhost/zomato-back-end/APIs/admin-display-users.php' -->