<?php

require_once __DIR__ . '/../../models/Student.php';

if (isset($_POST['email'], $_POST['pass'])) {

    $email = $_POST['email'];
    $pass  = $_POST['pass'];

    $student = new Student();
    $stmt = $student->login($email, $pass);

    if ($stmt && $stmt->rowCount() === 1) {

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $row['name'];
        $_SESSION['id'] = $row['id'];

        header("Location: /WAF/Code/index.php?page=search");
        exit;

    } else {
        header("Location: /WAF/Code/index.php?page=login&error=user");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/WAF/Code/pages/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="/WAF/Code/pages/CSS/style.css">
</head>

<body class="bg-light">

<div class="container mt-5 w-50 p-4 shadow-lg border rounded">

    <h3 class="text-center">Log in</h3>
    <p class="text-center text-muted">Never stop learning!</p>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger text-center">
            <?php
                if ($_GET['error'] === 'pass') echo 'Wrong password.';
                if ($_GET['error'] === 'user') echo 'User does not exist.';
            ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <div class="input-group mb-3">
          <!-- vulnerability 2 is the type -->
            <input type="text" class="form-control" name="email" placeholder="E-mail" required>
        </div>

        <div class="input-group mb-3">
            <input type="password" class="form-control" name="pass" placeholder="Password" required>
        </div>

        <div class="d-grid">
            <button class="btn btn-primary" type="submit">Log in</button>
        </div>
    </form>
</div>

<script src="/WAF/Code/pages/JS/bootstrap.min.js"></>
<script src="/WAF/Code/pages/JS/main.js"></script>

</body>
</html>
