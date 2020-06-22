<?php 
// Sanitize Input
function sanitize($value) {
    if (!empty($value)) {
        return htmlentities(strip_tags(trim($_POST[$value])));
    }
    return false;
}

if ($_POST['action'] === "LOGIN") {
    // Login Validation
    $email = sanitize('email');
    $password = sanitize('password');

    if ($email !== "" || $password !== "") {
        echo "Validation successful";
        exit;
    } else {
        echo "Invalid Login Credentials";
    }
}

if ($_POST['action'] === "REGISTER") {
    // Register Validation
    $username = sanitize('username');
    $email = sanitize('email');
    $password = sanitize('password');
    $confirm = sanitize('confirm');

    if ($username !== "" && $email !== "" && $password !== "" && $confirm !== "" ) {
        if ($password === $confirm) {
            echo "Validation successful";
            exit;
        } else {
            echo "Password doesn't match";    
        }
    } else {
        echo "All fields are required";
    }
}

