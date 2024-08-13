<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: vote.php");
    exit();
}
?>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>
</body>
</html>