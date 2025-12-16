<?php
// INTENTIONALLY VULNERABLE SSRF LAB
// No validation, no filtering, no allowlist

$success = '';
$error = '';

if (isset($_GET['url'])) {
    $url = $_GET['url'];

    // Server-side request (SSRF core)
    $data = @file_get_contents($url);

    if ($data !== false) {

        // Ensure upload directory exists
        $uploadDir = __DIR__ . '/uploads';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Save fetched content
        file_put_contents($uploadDir . '/preview.txt', $data);

        $success = "Imported content successfully from: <b>$url</b>";
    } else {
        $error = "Failed to fetch the provided URL.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Import Course Content</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #2c3e50;
        }

        .subtitle {
            text-align: center;
            color: #777;
            margin-bottom: 25px;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #3498db;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #2980b9;
        }

        .success {
            background: #e8f8f5;
            border: 1px solid #1abc9c;
            padding: 10px;
            margin-bottom: 15px;
        }

        .error {
            background: #fdecea;
            border: 1px solid #e74c3c;
            padding: 10px;
            margin-bottom: 15px;
        }

        .examples {
            margin-top: 25px;
            font-size: 14px;
        }

        code {
            background: #eee;
            padding: 4px;
            display: inline-block;
            margin-top: 5px;
        }

    </style>
</head>
<body>

<div class="container">
    <h1>Import Course Syllabus</h1>

    <p class="subtitle">
        Paste a URL to import course material or preview.
    </p>

    <?php if ($success): ?>
        <div class="success"><?= $success ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="GET">
        <input type="hidden" name="page" value="import">
        <input type="text" name="url" placeholder="http://example.com/syllabus.pdf" required>
        <button type="submit">Import</button>
    </form>

    <div class="examples">
        <h3>Examples</h3>
        <code>http://localhost/Content/python_syllabus.pdf</code><br>
        <code>http://localhost/phpmyadmin/</code>
    </div>
</div>

</body>
</html>
