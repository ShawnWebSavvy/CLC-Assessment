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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vote->vote_id = $_POST['vote_id'];

    if ($vote->submitVote()) {
        $message = 'Vote submitted successfully.';
    } else {
        $message = 'You have already voted.';
    }
}

$results = $vote->getPollResults();
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

    <form id="vote-form" method="post">
        <label>What is your favourite coding language?</label>
        <select name="vote_id" required>
            <?php
            // Fetching all available voting options
            $query = "SELECT id, option FROM votes";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $options = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($options as $option) { ?>
                <option value="<?php echo $option['id']; ?>"><?php echo htmlspecialchars($option['option']); ?></option>
            <?php } ?>
        </select>
        <button type="submit">Submit Vote</button>
        <div id="message"><?php echo isset($message) ? $message : ''; ?></div>
    </form>

    <h2>Poll Results:</h2>
    <ul>
        <?php foreach ($results as $result) { ?>
            <li><?php echo htmlspecialchars($result['option']); ?>: <?php echo $result['votes']; ?> votes</li>
        <?php } ?>
    </ul>
    <script src="assets/script.js"></script>
</body>
</html>