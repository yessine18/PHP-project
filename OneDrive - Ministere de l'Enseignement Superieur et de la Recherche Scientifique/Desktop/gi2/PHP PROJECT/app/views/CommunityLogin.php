<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../inc/css/login.css">
</head>
<body>
    <div class="wrapper">
        <form action="index.php?page=astronomy" method="POST">
            <h2>Sign In</h2>
            <?php if (isset($error)): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <div class="input-field">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>

            <div class="input-field">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>

            <div class="role-buttons">
                <button type="button" class="role-button active" onclick="selectRole('user')">User</button>
                <button type="button" class="role-button" onclick="selectRole('superadmin')">Admin</button>
            </div>
            <button type="submit">Sign In</button>
            <div class="register">
                <p>Don't have an account? <a href="index.php?page=application">Sign up</a></p>
            </div>
        </form>
    </div>
</body>
</html>
