<?php
session_start();
require_once 'supabase_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signIn'])) {
    // Validate and sanitize inputs
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = md5($_POST['password']); // Using MD5 to match registration

    if (empty($email) || empty($password)) {
        header("Location: index.php?error=Email and password are required!");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.php?error=Invalid email format!");
        exit();
    }

    // Query Supabase for user
    $response = supabaseApi('/rest/v1/users?email=eq.' . urlencode($email) . '&password=eq.' . urlencode($password), 'GET');

    if ($response['status'] === 200 && !empty($response['data'])) {
        $user = $response['data'][0];
        $_SESSION['email'] = $user['email'];
        $_SESSION['firstName'] = $user['firstname'];
        $_SESSION['lastName'] = $user['lastname'];
        $_SESSION['user_id'] = $user['id'];
        
        header("Location: home.php");
        exit();
    } else {
        header("Location: index.php?error=Incorrect Email or Password");
        exit();
    }
} else {
    // If accessed directly, redirect to index
    header("Location: index.php");
    exit();
}
?> 