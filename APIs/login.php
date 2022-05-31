<?php
include("connection.php");
if(isset($_POST["email"])) $email = $_POST["email"];
if(isset($_POST["password"])) $password = hash("sha256", $_POST["password"]);
$query = $mysqli->prepare("Select user_id, role_name from users u, roles r where u.role_id = r.role_id and email = ? AND password = ?");
$query->bind_param("ss", $email, $password);
$query->execute();
$query->store_result();
$num_rows = $query->num_rows;
$query->bind_result($id, $role_name);
$query->fetch();
$response = [];
if($num_rows == 0){
    $response["response"] = "Invalid email or password";
}else{
    $response["user_id"] = $id;
    if ($role_name === "user") $response["response"] = "User Logged in";
    else $response["response"] = "Admin Logged in";
}
$json = json_encode($response);
echo $json;
?>