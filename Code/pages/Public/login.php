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
<style>
    /* Reset and body styling */
    .login-card {
        background-color: #fff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 400px;
        text-align: center;
        margin: auto;
    }

    .login-card h2 {
        margin-bottom: 10px;
        font-weight: 600;
    }

    .login-card p {
        margin-bottom: 30px;
        color: #6c757d;
    }

    /* Input fields */
    .login-card input[type="email"],
    .login-card input[type="text"] {
        width: 100%;
        padding: 12px 15px;
        margin-bottom: 20px;
        border-radius: 6px;
        border: 1px solid #ced4da;
        font-size: 16px;
    }

    .login-card input[type="email"]:focus,
    .login-card input[type="text"]:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
    }

    /* Button styling */
    .login-card button {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        border: none;
        border-radius: 6px;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .login-card button:hover {
        background-color: #0056b3;
    }
    .alert {
        background-color: #f8d7da;   /* light red */
        color: #721c24;             /* dark red text */
        padding: 10px 15px;
        border-radius: 6px;
        margin-bottom: 20px;
        border: 1px solid #f5c6cb;
        text-align: center;
        font-size: 14px;
    }
</style>
<div class="login-card">
    <?php if (isset($_GET['error'])): ?>
        <div class="alert">
            <?php
                if ($_GET['error'] === 'pass') echo 'Wrong password.';
                if ($_GET['error'] === 'user') echo 'User does not exist.';
            ?>
        </div>
    <?php endif; ?>
        <h2>Log in</h2>
        <p>Never stop learning!</p>
        <form method="post" action="?page=login">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="text" name="pass" placeholder="Password" required>
            <button type="submit">Log in</button>
        </form>
    </div>                                                                          
</div>

