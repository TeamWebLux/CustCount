<?php
session_start(); // Start the session

function setToast($type, $message) {
    $_SESSION['toast'] = ['type' => $type, 'message' => $message];
}

include '../db/db_connect.php';

// Default redirect location set to the registration page for reattempt
$redirectTo = '../../index.php/Register_to_CustCount';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $fullname = trim($_POST['fullname']);
    $username = trim($_POST['username']);
    $role = trim($_POST['role']);
    $termsAccepted = isset($_POST['terms']) && $_POST['terms'] == 'on';

    // Additional fields
    $fbLink = trim($_POST['fb_link']);
    $pageId = trim($_POST['page_id']);
    $ipAddress = $_SERVER['REMOTE_ADDR'];

    // Validate inputs are not empty
    if (empty($fullname) || empty($username) || empty($role) || !$termsAccepted) {
        // Set error message and retain form values
        setToast('error', 'Please fill in all required fields and accept the terms.');
        $_SESSION['form_values'] = $_POST;
        header('Location: ' . $redirectTo);
        exit();
    }

    // Check if username already exists
    $checkUsernameSql = "SELECT username FROM user WHERE username = ?";
    if ($stmt = $conn->prepare($checkUsernameSql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            // Username already exists
            setToast('error', 'Username already taken. Please choose another.');
            $_SESSION['form_values'] = $_POST;
            $stmt->close();
            header('Location: ' . $redirectTo);
            exit();
        }
        $stmt->close();
    } else {
        setToast('error', 'Error preparing statement: ' . $conn->error);
        header('Location: ' . $redirectTo);
        exit();
    }

    // Proceed with database insertion since validation passed
    $sql = "INSERT INTO user (name, username, `Fb-link`, page_id, ip_address, status, `by`, last_login, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), NOW())";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssss", $fullname, $username, $fbLink, $pageId, $ipAddress, $status, $by);

        // You need to define the values for the additional fields, assuming you have them
        $status = ''; // Replace with actual value
        $by = ''; // Replace with actual value
        $lastLogin = ''; // Replace with actual value
        //$createdAt = NOW(); // You can use NOW() for the current timestamp
        //$updatedAt = NOW(); // You can use NOW() for the current timestamp

        if ($stmt->execute()) {
            setToast('success', 'New record created successfully.');
            $redirectTo = '../../index.php'; // Success: Redirect to the home page or dashboard
        } else {
            setToast('error', 'Error: ' . $stmt->error);
        }
        $stmt->close();
    } else {
        setToast('error', 'Error preparing statement: ' . $conn->error);
    }
    $conn->close();
} else {
    setToast('error', 'Invalid request method.');
}

// Redirect based on the outcome
header('Location: ' . $redirectTo);
exit();
?>
