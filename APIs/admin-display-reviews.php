<?php
header('Access-Control-Allow-Origin: *');
  
include("connection.php");

$query = $mysqli->prepare("SELECT restaurants.name, users.first_name, users.last_name, reviews.rating, reviews.content, reviews.date_posted, reviews.status
FROM reviews 
INNER JOIN restaurants
ON reviews.restaurant_id = restaurants.restaurant_id
INNER JOIN users
ON reviews.user_id = users.user_id");

// SELECT restaurants.name, users.first_name, users.last_name, reviews.rating, reviews.content, reviews.date_posted, reviews.status
// FROM reviews 
// INNER JOIN restaurants
// ON reviews.restaurant_id = restaurants.restaurant_id
// INNER JOIN users
// ON reviews.user_id = users.user_id

$query->execute();
$array = $query->get_result();
$response = [];
while($user = $array->fetch_assoc()){
    $response[] = $user;
} 

$json = json_encode($response);
echo $json;

?>

<!-- http://localhost/zomato-back-end/APIs/admin-display-reviews.php' -->