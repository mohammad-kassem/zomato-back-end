<?php
include("connection.php");
header('Access-Control-Allow-Origin: *');

$user_id = $_POST["user_id"];
$restaurant_id = $_POST["restaurant_id"];
$rating = $_POST["rating"];
$content = $_POST["content"];
$status = 0;
$query = $mysqli->prepare("Insert into reviews (user_id, restaurant_id, rating, content, status, date_posted) VALUES (?, ?, ?, ?, 0, NOW())");
$query->bind_param("iiis", $user_id, $restaurant_id, $rating, $content);
$query->execute();
$response["response"] = "Review added successfully";
$json = json_encode($response);
echo $json;
?>