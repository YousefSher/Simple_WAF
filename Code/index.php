<?php
// C:\xampp\htdocs\courses\index.php

$page = $_GET['page'] ?? 'home';

// ENDPOINT 1: Home (Safe)
if ($page == 'home') {
    echo "<h1>Welcome to OpenCourse</h1><p>System is running.</p>";
}

// ENDPOINT 2: Login (Vulnerable to SQL Injection)
elseif ($page == 'login') {
    $user = $_GET['username'] ?? '';
    // Vulnerability: We just print the attack to prove it worked
    echo "<h1>Login Endpoint</h1>";
    echo "Executing Database Query: SELECT * FROM users WHERE name = '$user'";
}

// ENDPOINT 3: Search (Vulnerable to XSS)
elseif ($page == 'search') {
    $q = $_GET['q'] ?? '';
    // Vulnerability: We print the script tag back to the browser
    echo "<h1>Search Results</h1>";
    echo "You searched for: " . $q; 
}

// ENDPOINT 4: Download (Vulnerable to Path Traversal)
elseif ($page == 'download') {
    $file = $_GET['file'] ?? '';
    // Vulnerability: We show the path the server would try to read
    echo "<h1>Download Endpoint</h1>";
    echo "Server attempting to open file at: /var/www/files/" . $file;
}

// ENDPOINT 5: Import (Vulnerable to SSRF)
elseif ($page == 'import') {
    $url = $_GET['url'] ?? '';
    // Vulnerability: We show the URL the server is about to fetch
    echo "<h1>Import Endpoint</h1>";
    echo "Server is fetching data from internal URL: " . $url;
}
?>