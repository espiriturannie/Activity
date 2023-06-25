<?php

include 'config.php';

$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];

$user_id = $_SESSION['user_id'];
$sql = "SELECT password FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$hashed_password = $row['password'];

if (password_verify($current_password, $hashed_password)) {
    $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password='$new_hashed_password' WHERE id='$user_id'";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        echo json_encode(array("message" => "Password updated successfully."));
    } else {
        echo json_encode(array("message" => "Error: " . mysqli_error($conn)));
    }
} else {
    echo json_encode(array("message" => "Incorrect current password."));
}

mysqli_close($conn);

?>
