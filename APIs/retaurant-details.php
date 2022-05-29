<?php
include("connection.php");

$user_id = $_GET["user_id"];
$restaurant_id = $_GET["restaurant_id"];
$query=$mysqli->prepare("Select r.restaurant_name, c.category_name, r.location, avg(re.rating) from restaurants r, categories c, reviews re where r.restaurant_id = ? and r.category_id = c.category_id and r.restaurant_id = re.restaurant_id group by re.restaurant_id");
$query->bind_param("i", $restaurant_id);
$query->execute();
$array= $query->get_result();
$response = [];
$response = $array->fetch_assoc();
$json = json_encode($response);
echo $json;
?>
