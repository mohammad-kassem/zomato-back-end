<?php
include("connection.php");
if(isset($_POST["email"])) $email = $_POST["email"];
if(isset($_POST["password"])) $password = hash("sha256", $_POST["password"]);
if(isset($_POST["first_name"])) $first_name = $_POST["first_name"];
if(isset($_POST["last_name"])) $last_name = $_POST["last_name"];
$query = $mysqli->prepare("Select user_id from users where email = ? AND password = ?");
$query->bind_param("ss", $email, $password);
$query->execute();
$num_rows = $query->num_rows;
$response = [];
if($num_rows == 0){
    $query = $mysqli->prepare("Insert into users (email, password, first_name, last_name, date_joined) values (?, ?, ?, ?, NOW())");
    $query->bind_param("ssss", $email, $password, $first_name, $last_name);
    $query->execute();
    $response["response"] = "User added successfully";
}else{
    $response["response"] = "User already exists";
}

$json = json_encode($response);
echo $json;
?>