<?php

include 'config.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
        session_start();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['firstname'] = $row['firstname'];
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['birthdate'] = $row['birthdate'];
        echo json_encode(array("message" => "Login successful.", "user_data" => $_SESSION));
    } else {
        echo json_encode(array("message" => "Incorrect email or password."));
    }
} else {
    echo json_encode(array("message" => "Incorrect email or password."));
}

mysqli_close($conn);

?>
