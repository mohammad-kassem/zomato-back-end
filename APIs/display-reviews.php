<?php
include("connection.php");
$user_id = $_GET["user_id"];
$restaurant_id = $_GET["restaurant_id"];
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
