<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Not logged in, redirect to login page
    header("Location: /WAF/Code/index.php?page=login");
    exit;
}

// Get the user's name from session
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .welcome { font-size: 24px; }
        .logout { margin-top: 20px; }
        .logout a { text-decoration: none; color: white; background-color: red; padding: 10px 20px; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="welcome">
        Welcome, <?php echo htmlspecialchars($username); ?>!
    </div>

    <div class="logout">
        <a href="?page=login" class="<?php echo $page == 'login' ? 'active' : ''; ?>">Log Out</a>
    </div>
</body>
</html>
