<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/User.php';

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User($db);
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];
    $user_id = $user->login();

    if ($user_id) {
        $_SESSION['user_id'] = $user_id;
        header("Location: vote.php");
        exit();
    } else {
        $message = 'Invalid credentials.';
    }
}
?>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>

<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>

    <form id="login-form" method="post">
        <label>Username:</label><input type="text" name="username" required>
        <label>Password:</label><input type="password" name="password" required>
        <button type="submit">Login</button>
        <div id="message"><?php echo isset($message) ? $message : ''; ?></div>
    </form>
    <script src="assets/script.js"></script>
</body>
</html>




