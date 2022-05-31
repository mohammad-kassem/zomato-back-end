<?php
include("connection.php");
if(isset($_GET["user_id"])) $user_id = $_GET["user_id"];
else die("Please log in");
if(isset($_GET["restaurant_id"])) $restaurant_id = $_GET["restaurant_id"];
else die("Please specify a restaurant");
$query=$mysqli->prepare("Select concat(u.first_name, ' ', u.last_name) as full_name, re.content, re.rating, re.date_posted from users u, reviews re where re.restaurant_id = ? and re.status = 1 and u.user_id = re.user_id");
$query->bind_param("i", $restaurant_id);
$query->execute();
$array= $query->get_result();
$response = [];
while ($row = $array->fetch_assoc()){
    $response[] = $row;
}
$json = json_encode($response);
echo $json;
?>
