<?php
include("connection.php");
if(isset($_GET["user_id"])) $user_id = $_GET["user_id"];
else die("Please log in");
if(isset($_GET["restaurant_id"])) $restaurant_id = $_GET["restaurant_id"];
else die("Please specify a restaurant");
$query=$mysqli->prepare("Select r.restaurant_name, r.description as restaurant_description, r.image, r.location, r.average_cost, avg(re.rating) as restaurant_rating from restaurants r, reviews re where r.restaurant_id = ? and re.restaurant_id = ?");
$query->bind_param("ii", $restaurant_id, $restaurant_id);
$query->execute();
$array= $query->get_result();
$response = [];
$response = $array->fetch_assoc();
$json = json_encode($response);
echo $json;
?>
