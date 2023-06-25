<?php

include 'config.php';

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$birthdate = $_POST['birthdate'];
$password = $_POST['password'];
  
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (firstname, lastname, email, birthdate, password)
        VALUES ('$firstname', '$lastname', '$email', '$birthdate', '$hashed_password')";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo json_encode(array("message" => "User registered successfully."));
} else {
    echo json_encode(array("message" => "Error: " . mysqli_error($conn)));
}

mysqli_close($conn);

?>