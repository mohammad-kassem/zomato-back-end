<?php
include("connection.php");
if(isset($_POST["user_id"])) $user_id = $_POST["user_id"];
else die("Please log in");
if(isset($_POST["restaurant_id"])) $restaurant_id = $_POST["restaurant_id"];
else die("Please specify a restaurant");
if(isset($_POST["rating"])) $rating = $_POST["rating"];
else die("Please enter all the required fields");
if(isset($_POST["content"])) $content = $_POST["content"];
else die("Please enter all the required fields");
if($rating and $content){
$query = $mysqli->prepare("Insert into reviews (user_id, restaurant_id, rating, content, status, date_posted) VALUES (?, ?, ?, ?, 0, NOW())");
$query->bind_param("iiis", $user_id, $restaurant_id, $rating, $content);
$query->execute();
$response["response"] = "Review added successfully";}
$json = json_encode($response);
echo $json;
?>