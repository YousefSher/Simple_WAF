<?php
include __DIR__ . '/../../models/Student.php';
$_SESSION['loggedin'] = false;
if (isset($_REQUEST['email'], $_REQUEST['pass'])) {

    $email = $_REQUEST['email'];
    $pass  = $_REQUEST['pass'];

    $student = new Student();
    $result = $student->login($email, $pass);

    if ($result && $result->rowCount() >= 1) {
        $row = $result->fetch(PDO::FETCH_ASSOC);

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $row['name'];

        header("Location: ?page=home");
        exit;
    } else {
        header("Location: ?page=login&error=user");
        exit;
    }
}

?>

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

