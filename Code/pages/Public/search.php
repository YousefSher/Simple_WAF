<?php
include __DIR__ . '/../../models/Course.php';

$results = [];
$search_term = '';

if (isset($_GET['query'])) {
    $search_term = $_GET['query'];
    $courseModel = new Course();
    $results = $courseModel->search($search_term);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Courses</title>
    <style>
    /* 1. Base Setup */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f6f8;
        color: #333;
        margin: 0;
        padding: 40px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* 2. Page Title */
    h1 {
        color: #2c3e50;
        margin-bottom: 30px;
    }

    /* 3. Search Form Styling */
    form {
        width: 100%;
        max-width: 600px;
        display: flex;
        gap: 10px;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
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
        border-color: #3498db;
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
        margin-top: 40px;
        color: #7f8c8d;
        font-weight: 400;
        border-bottom: 2px solid #ddd;
        padding-bottom: 10px;
        width: 100%;
        max-width: 600px;
    }

    .results {
        width: 100%;
        max-width: 600px;
        margin-top: 20px;
    }

    .result-item {
        background: white;
        padding: 20px;
        margin-bottom: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        border-left: 5px solid #3498db;
        transition: transform 0.2s;
    }

    .result-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    .result-item h4 {
        margin: 0 0 10px 0;
        color: #2c3e50;
        font-size: 1.2rem;
    }

    .result-item p {
        margin: 0;
        color: #666;
        line-height: 1.5;
    }

    p.no-results {
        text-align: center;
        color: #7f8c8d;
        margin-top: 20px;
    }
</style>
</head>
<body>

    <h1>Find a Course</h1>

    <form action="" method="GET">
        <input type="text" name="query" placeholder="Search..." value="<?php echo $search_term; ?>">
        <button type="submit">Search</button>
    </form>

    <?php if ($search_term): ?>
        <hr>
        <h3>Results for: <?php echo $search_term; ?></h3>

        <div class="results">
            <?php if (!empty($results)): ?>
                <?php foreach ($results as $course): ?>
                    <div class="result-item">
                        <h4><?php echo htmlspecialchars($course['title']); ?></h4>
                        <p><?php echo htmlspecialchars($course['description']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No courses found.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</body>
</html>