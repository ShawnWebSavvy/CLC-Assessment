<style>
nav {
  background-color: #333;
  padding: 10px;
}

nav ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
}

nav ul li {
  float: left;
  margin-right: 10px;
}

nav ul li a {
  display: block;
  color: white;
  text-align: center;
  padding: 10px;
  text-decoration: none;
}

nav ul li a:hover {
  background-color: #575757;
}
</style>
<nav>
    <ul>
        <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="vote.php">Vote</a></li>
            <li><a href="poll.php">Poll Results</a></li>
            <li><a href="logout.php">Log Out</a></li>
        <?php else: ?>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>
<br/><br/>