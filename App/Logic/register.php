<?php
session_start(); // Start the session
include "creation.php";

function setToast($type, $message)
{
    $_SESSION['toast'] = ['type' => $type, 'message' => $message];
}

include '../db/db_connect.php';

// Default redirect location set to the registration page for reattempt
$redirectTo = '../../index.php/add_user';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r($_POST);
    // Retrieve and sanitize form data
    $fullname = trim($_POST['name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $role = trim($_POST['role']);
    $termsAccepted = isset($_POST['terms']) && $_POST['terms'] == 'on';

    // Additional fields
    $fbLink = trim($_POST['fb_link']);
    $pageId = trim($_POST['pagename']);
    // $branchname = trim($_POST['branchname']);
    $by_u = $_SESSION['username'];

    if (isset($_POST['branchname']) && $_POST['branchname'] !== '') {
        // If branchname is provided, sanitize and set the branchId
        $branchId = $_POST['branchname'];
    } else {
        // If branchname is not provided, fetch the branchId based on pageId
        $creationInstance = new Creation($conn);
        $branchId = $creationInstance->getBranchNameByPageName($pageId, $conn);
    }

    // Get the user's IP address
    $ipAddress = $_SERVER['REMOTE_ADDR'];

    // Validate inputs are not empty
    if (empty($fullname) || empty($username) || empty($role)) {
        // Set error message and retain form values
        setToast('error', 'Please fill in all required fields and accept the terms.');
        $_SESSION['form_values'] = $_POST;
        print_r($_POST);
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
            setToast('error', 'Username already taken. Please choose another.');
            $_SESSION['form_values'] = $_POST;
            print_r($_POST);

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

    // Define additional fields' values
    $status = '1'; // Replace with actual value
    // Replace with actual value

    // Proceed with database insertion since validation passed
    $sql = "INSERT INTO user (name, username, `Fb-link`, pagename, branchname, ip_address, password, status, role, `by`, last_login, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), NOW())";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssssss", $fullname, $username, $fbLink, $pageId, $branchId, $ipAddress, $password, $status, $role, $by_u);

        if ($stmt->execute()) {
            setToast('success', 'New record created successfully.');
            $redirectTo = '../../index.php/Portal'; // Success: Redirect to the home page or dashboard
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
