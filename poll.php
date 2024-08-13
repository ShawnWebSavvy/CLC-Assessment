<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Vote.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();
$vote = new Vote($db);
$vote->user_id = $_SESSION['user_id'];

$results = $vote->getPollResults();
$total_votes = $vote->getTotalVotes();
?>
<html>
<head>
    <title>Vote</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>

    <h2>Poll Results:</h2>
    <ul>
        <?php foreach ($results as $result) { ?>
            <li><?php echo htmlspecialchars($result['option']); ?>: <?php echo $result['votes']; ?> votes :
            <?php echo $percentage = ($total_votes > 0) ? ($result['votes'] / $total_votes) * 100 : 0; ?>%
        </li>
        <?php } ?>
    </ul>

    Total Votes: <?php echo $total_votes ?>
    <script src="assets/script.js"></script>
</body>
</html>