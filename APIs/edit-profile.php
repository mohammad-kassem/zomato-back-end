<?php
include("connection.php");
header('Access-Control-Allow-Origin: *');

$user_id = $_POST["user_id"];
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$dob = $_POST["dob"];
$gender = $_POST["gender"];
$location = $_POST["location"];
$old_password = hash("sha256", $_POST["old_password"]);
$new_password = hash("sha256", $_POST["new_password"]);
$confirm_password = hash("sha256", $_POST["confirm_password"]);
$query=$mysqli->prepare("Update users set first_name = ?, last_name = ?, dob = ?, gender = ?, location = ? where user_id = ?");
$query->bind_param("sssisi", $first_name, $last_name, $dob, $gender, $location, $user_id);
$query->execute();
$query=$mysqli->prepare("Select password from users where user_id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$query->store_result();
$query->bind_result($db_password);
$query->fetch();
if ($db_password == $old_password and $new_password == $confirm_password){
    $query->prepare("Update users set password = ? where user_id = ?");
    $query->bind_param("si", $new_password, $user_id);
    $query->execute();
    $response["new_password"] = $new_password;
    $response["response"] = "Password update successfully";
} else{
    $response["response"] = "No matching passwords";
}
$json = json_encode($response);
    echo $json;
?>
