<?php
include("connection.php");
$user_id = $_GET["user_id"];
$query = $mysqli->prepare("Select user_id from users where user_id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$query->store_result();
$num_rows = $query->num_rows;
$query=$mysqli->prepare("Select r.restaurant_name, c.category_name, r.location, avg(re.rating) as restaurant_rating from restaurants r, categories c, reviews re where r.category_id = c.category_id and r.restaurant_id = re.restaurant_id group by re.restaurant_id");
$query->execute();
$array = $query->get_result();
$response =[];
while ($row = $array->fetch_assoc()){
    $response[] = $row;
}

$json = json_encode($response);
echo $json;
?>

