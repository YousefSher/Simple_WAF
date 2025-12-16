<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Not logged in, redirect to login page
    header("Location: ?page=login");
    exit;
}

// Get the user's name from session
$username = $_SESSION['username'];
?>

<div class="home">
    <div class="welcome">
        Welcome, <?php echo htmlspecialchars($username); ?>!
    </div>

    <div class="logout">
        <a href="?page=login" class="<?php echo $page == 'login' ? 'active' : ''; ?>">Log Out</a>
    </div>
</div>

