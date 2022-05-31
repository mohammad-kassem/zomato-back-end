<?php
include("connection.php");
if(isset($_GET["user_id"])) $user_id = $_GET["user_id"];
else die("Please log in");
$query=$mysqli->prepare("Select r.restaurant_id, r.restaurant_name, r.image, avg(re.rating) as rating from restaurants r left join reviews re on r.restaurant_id = re.restaurant_id group by r.restaurant_id");
$query->execute();
$array = $query->get_result();
$response =[];
while ($row = $array->fetch_assoc()){
    $response[] = $row;
}

$json = json_encode($response);
echo $json;
?>

