<?php
$base_dir = __DIR__ . '/../../../Content/';
$error_msg = '';

if (isset($_GET['file'])) {
    // VULNERABILITY: We take the input directly (Path Traversal Entry Point)
    $file = $_GET['file'];
    
    $filepath = $base_dir . $file;

    if (file_exists($filepath) && is_file($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        //This line forces browser to download the file
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        
        ob_clean();
        flush();
        
        //Reads file and copies its content to response body (Download)
        readfile($filepath);
        exit;
    } else {
        $error_msg = "Error: File '" . htmlspecialchars($file) . "' not found.";
    }
}
?>

<style>
    .download-container {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        margin: 40px auto; 
        padding: 0 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 800px;
    }

    h1 {
        color: #2c3e50;
        margin-bottom: 30px;
    }

    .error-box {
        background-color: #fee;
        color: #c0392b;
        border: 1px solid #f5c6cb;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        width: 100%;
        text-align: center;
    }

    .file-card {
        background: white;
        padding: 20px;
        margin-bottom: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        border-left: 5px solid #3498db;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: transform 0.2s;
        width: 100%; /* Ensure cards fill the container */
    }

    .file-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    .file-info h4 {
        margin: 0 0 5px 0;
        color: #2c3e50;
        font-size: 1.1rem;
    }

    .file-info p {
        margin: 0;
        color: #7f8c8d;
        font-size: 0.9rem;
    }

    .btn-download {
        background-color: #3498db;
        color: white;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 4px;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .btn-download:hover {
        background-color: #2980b9;
    }
</style>

<div class="download-container">

    <h1>Course Syllabuses</h1>

    <?php if ($error_msg): ?>
        <div class="error-box">
            <?php echo $error_msg; ?>
        </div>
    <?php endif; ?>

    <div class="file-card">
        <div class="file-info">
            <h4>Python Programming Syllabus</h4>
            <p>Fall 2025 • PDF Format</p>
        </div>
        <a href="?page=download&file=python_syllabus.pdf" class="btn-download">Download</a>
    </div>

    <div class="file-card">
        <div class="file-info">
            <h4>Web Security Essentials</h4>
            <p>Spring 2025 • PDF Format</p>
        </div>
        <a href="?page=download&file=security_intro.pdf" class="btn-download">Download</a>
    </div>

</div>