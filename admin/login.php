<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Check credentials
    if ($_POST['username'] === 'admin' && $_POST['password'] === 'yourpassword') {
        $_SESSION['loggedin'] = true;
        header('Location: index.php'); // Redirect to admin page
        exit;
    } else {
        $error = 'Invalid credentials';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
    </form>
</body>
</html>
