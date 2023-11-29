<?php
include '../../config/connection.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $username = $_POST['nomor_identitas'];
    $old_password = $_POST['password'];
    $new_password = $_POST['newPassword'];

    // Check the match of the old password in the database
    $sql = "SELECT * FROM users WHERE nomor_identitas='$username' AND password='$old_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Change the password if the old password matches the one in the database
        $update_sql = "UPDATE users SET password='$new_password' WHERE username='$username'";
        if ($conn->query($update_sql) === TRUE) {
            echo "Password changed successfully";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Old password does not match";
    }
}

$conn->close();
?>