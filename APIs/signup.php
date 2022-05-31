<?php
include("connection.php");
if(isset($_POST["email"])) $email = $_POST["email"];
else die("Please enter all the required fields");
if(isset($_POST["password"])) $password = hash("sha256", $_POST["password"]);
else die("Please enter all the required fields");
if(isset($_POST["first_name"])) $first_name = $_POST["first_name"];
else die("Please enter all the required fields");
if(isset($_POST["last_name"])) $last_name = $_POST["last_name"];
else die("Please enter all the required fields");
$query = $mysqli->prepare("Select user_id from users where email = ? AND password = ?");
$query->bind_param("ss", $email, $password);
$query->execute();
$query->store_result();
$num_rows = $query->num_rows;
$response = [];
if($num_rows == 0){
    $query = $mysqli->prepare("Insert into users (email, password, first_name, last_name, role_id, date_joined) values (?, ?, ?, ?, 1, NOW())");
    $query->bind_param("ssss", $email, $password, $first_name, $last_name);
    $query->execute();
    $response["response"] = "User added successfully";
}else{
    $response["response"] = "User already exists";
}

$json = json_encode($response);
echo $json;
?>