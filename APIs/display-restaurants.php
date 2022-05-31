<?php
include("connection.php");
if(isset($_GET["user_id"])) $user_id = $_GET["user_id"];
else die("Please log in");
$query=$mysqli->prepare("Select r.restaurant_id, r.restaurant_name, location, r.image, avg(re.rating) as rating, c.category_name from restaurants r left join reviews re on r.restaurant_id = re.restaurant_id join categories c on c.category_id=r.category_id group by r.restaurant_id");
$query->execute();
$array = $query->get_result();
$response =[];
while ($row = $array->fetch_assoc()){
    $response[] = $row;
}

$json = json_encode($response);
echo $json;
?>

