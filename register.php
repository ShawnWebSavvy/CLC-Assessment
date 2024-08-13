<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$message = ''; // Initialize the message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verify reCAPTCHA response
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $secretKey = "6Lfx_CIqAAAAAIjw8EYnifeE8Ml9h0bUER3iYk7F";
    $verifyUrl = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse";
    
    $response = file_get_contents($verifyUrl);
    $responseData = json_decode($response);
    
    if ($responseData->success) {
        // If reCAPTCHA is successful, proceed with registration
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->username = $_POST['username'];
        $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $user->email = $_POST['email'];
        
        // Check if the username or email is already taken
        if ($user->isUsernameTaken()) {
            $message = 'Username is already taken. Please choose a different one.';
        } elseif ($user->isEmailTaken()) {
            $message = 'Email is already taken. Please use a different email.';
        } elseif ($user->register()) {
            $message = 'Registration successful. Please log in.';
        } else {
            $message = 'Registration failed. Please try again.';
        }
    } else {
        // reCAPTCHA failed
        $message = 'Please complete the reCAPTCHA.';
    }
}
?>

<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>

    <form id="register-form" method="post">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name">

        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>
        
        <!-- reCAPTCHA Widget -->
        <div class="g-recaptcha" data-sitekey="6Lfx_CIqAAAAAOgW0JVLxlHBsRe-bgHRBMltih5q"></div>

        <button type="submit">Register</button>
        <div id="message"><?php echo $message; ?></div>
    </form>
</body>
</html>