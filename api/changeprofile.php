<?php
session_start();

include 'config.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$birthdate = $_POST['birthdate'];

$user_id = $_SESSION['user_id'];
$sql = "UPDATE users SET firstname=?, lastname=?, email=?, birthdate=? WHERE id=?";
if($stmt = $mysqli->prepare($sql)){
    $stmt->bind_param("ssssi", $firstname, $lastname, $email, $birthdate, $user_id);
    
    if($stmt->execute()){
        header("location: profile.php");
        exit();
    } else{
        echo "Something went wrong. Please try again later.";
    }
}

$stmt->close();
}

$mysqli->close();
?>