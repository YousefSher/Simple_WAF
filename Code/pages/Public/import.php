<?php
$message = '';
$syllabus_content = '';

if (isset($_GET['syllabus_url'])) {
    $url = $_GET['syllabus_url'];
    
    if (!empty($url)) {
        // VULNERABILITY: Server-Side Request Forgery (SSRF)
        // The server will try to connect to ANY address you give it (localhost, internal IPs, etc.)
        $content = @file_get_contents($url);

        if ($content === FALSE) {
            $message = "Error: Could not retrieve syllabus from that URL.";
        } else {
            $message = "Syllabus imported successfully!";
            $syllabus_content = $content;
        }
    }
}
?>

<style>
    .import-container {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        margin: 40px auto;
        padding: 0 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 800px;
        width: 100%;
    }

    h1 {
        color: #2c3e50;
        margin-bottom: 30px;
    }

    /* Scoped form styling */
    .import-container form {
        width: 100%;
        max-width: 600px;
        display: flex;
        gap: 10px;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        box-sizing: border-box;
    }

    input[type="text"] {
        flex-grow: 1;
        padding: 12px 15px;
        border: 2px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        transition: border-color 0.3s;
    }

    input[type="text"]:focus {
        border-color: #8e44ad; /* Purple for Import page */
        outline: none;
    }

    button {
        padding: 12px 25px;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #2980b9;
    }

    h3 {
        margin-top: 20px;
        color: #2c3e50;
    }

    .preview-box {
        margin-top: 20px;
        background: white;
        padding: 20px;
        border-radius: 8px;
        width: 100%;
        max-width: 600px;
        border-left: 5px solid #8e44ad;
        min-height: 100px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        overflow-x: auto; /* Adds scrollbar if content is too wide */
    }

    pre {
        white-space: pre-wrap;
        word-wrap: break-word;
        margin: 0;
        font-family: Consolas, monospace;
        color: #555;
    }
</style>

<div class="import-container">

    <h1>Import Remote Syllabus</h1>
    <p style="margin-bottom: 20px; color: #666;">Enter the URL where your syllabus is hosted.</p>

    <form action="" method="GET">
        <input type="hidden" name="page" value="import">

        <input type="text" name="syllabus_url" placeholder="http://example.com/fall2025_syllabus.txt">
        <button type="submit">Fetch</button>
    </form>

    <?php if ($message): ?>
        <h3><?php echo $message; ?></h3>
    <?php endif; ?>

    <?php if ($syllabus_content): ?>
        <div class="preview-box">
            <h4 style="margin-top: 0; color: #8e44ad;">Syllabus Preview:</h4>
            <pre><?php echo htmlspecialchars($syllabus_content); ?></pre>
        </div>
    <?php endif; ?>

</div>