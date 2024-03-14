<?php
session_start();

// Include your database connection script
include '../db/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Retain the username in session for repopulating the form upon failure
    $_SESSION['login_form_values'] = ['username' => $username];

    $sql = "SELECT * FROM user WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                // Perform plain text password comparison (without hashing)
                if ($password === $row['password']) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $username;
                    $_SESSION['userid'] = $row['id'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['fullname'] = $row['name'];
                    // Clear retained form values upon successful login
                    unset($_SESSION['login_form_values']);
                    $_SESSION['toast'] = ['type' => 'success', 'message' => 'Successfully logged in'];
                    header("location: ../../index.php/Portal");
                } else {
                    $_SESSION['toast'] = ['type' => 'error', 'message' => 'Invalid username or password.'];
                    header("location: ../../");
                }
            } else {
                $_SESSION['toast'] = ['type' => 'error', 'message' => 'Invalid username or password.'];
                header("location: ../../");
            }
        } else {
            $_SESSION['toast'] = ['type' => 'error', 'message' => 'Oops! Something went wrong. Please try again later.'];
            header("location: ../../");
        }
        $stmt->close();
    } else {
        $_SESSION['toast'] = ['type' => 'error', 'message' => 'Database preparation error.'];
        header("location: ../../");
    }
    $conn->close();
} else {
    header("location: ../../");
}
