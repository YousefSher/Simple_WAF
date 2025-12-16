<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$page = $_GET['page'] ?? 'login';

$publicPages = ['login', 'search', 'import', 'download'];

if (!in_array($page, $publicPages) && !isset($_SESSION['loggedin'])) {
    header("Location: index.php?page=login");
    exit;
}

require __DIR__ . "/pages/Public/{$page}.php";

?>
