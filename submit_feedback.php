<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Submission</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="feedback.css">
</head>
<body>
    <section class="all">
        <header>
            <div class="container">
                <div class="logo">DeafUnityHub</div>
                <nav>
                    <ul id="nav-items">
                        <li><a href="/deaf/home.php">Home</a></li>
                        <li><a href="/deaf/resource.php">Resources</a></li>
                        <li><a href="/deaf/exercise.php">Exercises</a></li>
                        <li><a href="/deaf/feedback.php">Feedback</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="feedback-container">
            <?php
            session_start();
            require_once 'supabase_config.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Validate inputs
                if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['age']) || empty($_POST['feedback'])) {
                    header("Location: feedback.php?error=All fields are required!");
                    exit();
                }

                // Sanitize and prepare data
                $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $age = (int)$_POST['age'];
                $feedback = filter_var($_POST['feedback'], FILTER_SANITIZE_STRING);

                // Validate email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    header("Location: feedback.php?error=Invalid email format!");
                    exit();
                }

                // Validate age
                if ($age < 1 || $age > 120) {
                    header("Location: feedback.php?error=Please enter a valid age!");
                    exit();
                }

                // Prepare data for Supabase
                $feedbackData = [
                    'name' => $name,
                    'email' => $email,
                    'age' => $age,
                    'feedback' => $feedback,
                    'created_at' => date('c') // ISO 8601 date format
                ];

                // Send data to Supabase
                $response = supabaseApi('/rest/v1/feedback', 'POST', $feedbackData);

                if ($response['status'] === 201) { // 201 Created
                    // Store success message in session
                    $_SESSION['success_message'] = "Thank you! Your feedback has been successfully submitted.";
                    header("Location: home.php");
                    exit();
                } else {
                    $error = isset($response['data']['message']) ? $response['data']['message'] : 'An error occurred';
                    header("Location: feedback.php?error=" . urlencode("Error: " . $error));
                    exit();
                }
            } else {
                // Redirect to feedback page if accessed directly
                header("Location: feedback.php");
                exit();
            }
            ?>
        </div>
    </section>

    <style>
        .success-container {
            text-align: center;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            margin: 20px auto;
            max-width: 500px;
        }

        .success-message {
            color: #2e7d32;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .success-details {
            color: #555;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff6b35;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #e85a2c;
        }

        .error-message {
            background-color: #ffebee;
            color: #c62828;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
        }
    </style>
</body>
</html>
