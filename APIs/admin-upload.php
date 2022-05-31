<?php
header('Access-Control-Allow-Origin: *');

include("connection.php");

$restaurant_name = $_POST["restaurant_name"];
$location = $_POST["location"];
$average_cost = $_POST["average_cost"];
$description = $_POST["description"];
$category_id = $_POST["category_id"];
$image = $_POST["image"];
// $image = "hruvr";
// $logo = $_POST["logo"];
//$logo = "logo string";
$date_joined = date("Y-m-d H:i:s");


$query = $mysqli->prepare("INSERT INTO restaurants (restaurant_name, location, average_cost, description, category_id, image, date_joined) VALUES (?,?,?,?,?,?,?) ");
$query->bind_param("ssisiss", $restaurant_name, $location, $average_cost, $description, $category_id, $image, $date_joined);

$query->execute();

$response=[];


$response["success"] = true;
echo json_encode($response);

?>