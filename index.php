<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi ToDo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-container">
    <div class="login-box">
        <h2>Login</h2>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form action="proses/proses_login.php" method="post">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
