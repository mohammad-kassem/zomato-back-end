<?php
header('Access-Control-Allow-Origin: *');

include("connection.php");

$name = $_POST["name"];
$location = $_POST["location"];
$average_cost = $_POST["average_cost"];
$description = $_POST["description"];
$category_id = $_POST["category_id"];
$image = $_POST["image"];
$logo = $_POST["logo"];
$date_joined = $_POST["date_joined"];

$query = $mysqli->prepare("INSERT INTO restaurants (name, location, average_cost, description, category_id, image, logo, date_joined) VALUES (?,?,?,?,?,?,?,?) ");
$query->bind_param("ssdsisss", $name, $location, $average_cost, $description, $category_id, $image, $logo, $date_joined);

$query->execute();

$response=[];


$response["success"] = true;
echo json_encode($response);

?>