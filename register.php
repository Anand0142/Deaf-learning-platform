<?php
session_start();
require_once 'supabase_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signUp'])) {
    // Validate and sanitize inputs
    $firstName = filter_var($_POST['fName'], FILTER_SANITIZE_STRING);
    $lastName = filter_var($_POST['lName'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = md5($_POST['password']); // Using MD5 for compatibility

    if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        header("Location: index.php?error=All fields are required!");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.php?error=Invalid email format!");
        exit();
    }

    // Check if email exists
    $checkEmail = supabaseApi('/rest/v1/users?email=eq.' . urlencode($email), 'GET');
    
    if ($checkEmail['status'] === 200 && !empty($checkEmail['data'])) {
        header("Location: index.php?error=Email Address Already Exists!");
        exit();
    }

    // Prepare user data
    $userData = [
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'password' => $password
    ];

    // Insert user into Supabase
    $response = supabaseApi('/rest/v1/users', 'POST', $userData);

    if ($response['status'] === 201) { // 201 Created
        header("Location: index.php?success=Registration successful! Please login.");
        exit();
    } else {
        $error = isset($response['data']['message']) ? $response['data']['message'] : 'Registration failed';
        header("Location: index.php?error=" . urlencode($error));
        exit();
    }
} else {
    // If accessed directly, redirect to index
    header("Location: index.php");
    exit();
}
?>
