<?php
include("connection.php");
if(isset($_GET["user_id"])) $user_id = $_GET["user_id"];
else die("Please log in");
$query=$mysqli->prepare("Select r.restaurant_id, r.restaurant_name, c.category_name, r.location, avg(re.rating) as restaurant_rating from restaurants r, categories c, reviews re where r.category_id = c.category_id and r.restaurant_id = re.restaurant_id group by restaurant_id");
$query->execute();
$array = $query->get_result();
$response =[];
while ($row = $array->fetch_assoc()){
    $response[] = $row;
}

$json = json_encode($response);
echo $json;
?>

