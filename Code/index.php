<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1. Get the current page
$page = $_GET['page'] ?? 'login';

// 2. Define allowed pages
$allowedPages = ['login', 'search', 'import', 'download'];

// 3. Security Check
if (!in_array($page, $allowedPages, true)) {
    http_response_code(404);
    exit('Page not found');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WAF Demo App</title>
    <style>
        /* Global Navigation Styles */
        body { margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; background-color: #f4f6f8; }
        
        .navbar {
            background-color: #2c3e50;
            padding: 15px 0;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .navbar a {
            color: #ecf0f1;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 5px;
            font-weight: 500;
            border-radius: 4px;
            transition: background 0.3s;
        }

        .navbar a:hover {
            background-color: #34495e;
        }

        .navbar a.active {
            background-color: #3498db;
            color: white;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="?page=login" class="<?php echo $page == 'login' ? 'active' : ''; ?>">Login</a>
        <a href="?page=search" class="<?php echo $page == 'search' ? 'active' : ''; ?>">Search (SQLi)</a>
        <a href="?page=import" class="<?php echo $page == 'import' ? 'active' : ''; ?>">Import (SSRF)</a>
        <a href="?page=download" class="<?php echo $page == 'download' ? 'active' : ''; ?>">Download (Traversal)</a>
    </div>

    <?php require __DIR__ . "/pages/Public/{$page}.php"; ?>

</body>
</html>