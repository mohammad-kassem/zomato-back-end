<?php
include("connection.php");
if (isset($_POST["user_id"])) $user_id = $_POST["user_id"];
else die("Please log in");
if (isset($_POST["first_name"])) $first_name = $_POST["first_name"];
else die("Field cannot be left empty");
if (isset($_POST["last_name"])) $last_name = $_POST["last_name"];
else die("Field cannot be left empty");
if (isset($_POST["dob"])) $dob = $_POST["dob"];
if (isset($_POST["gender"])) $gender = $_POST["gender"];
if (isset($_POST["location"])) $user_location = $_POST["location"];
if (isset($_POST["old_password"])) $old_password = hash("sha256", $_POST["old_password"]);
if (isset($_POST["new_password"])) $new_password = hash("sha256", $_POST["new_password"]);
if (isset($_POST["confirm_password"])) $confirm_password = hash("sha256", $_POST["confirm_password"]);

//updating the fields that dont require authentication//
$query=$mysqli->prepare("Update users set first_name = ?, last_name = ?, dob = ?, gender = ?, location = ? where user_id = ?");
$query->bind_param("sssisi", $first_name, $last_name, $dob, $gender, $location, $user_id);
$query->execute();

//for updating the password the user must first enter their correct password//
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
