<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../inc/css/Signin.css">
</head>
<body>
    <div class="wrapper">
        <form action="index.php?page=add" method="POST">
            <h2>Sign Up</h2>
            <?php if (!empty($error)): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <div class="input-field">
                <input type="text" name="username" required>
                <label>Username</label>
            </div>
            <div class="input-field">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>
            <div class="input-field">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <div class="role-buttons">
                <label for="role">Role:</label>
                <select name="role" id="role" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit">Sign Up</button>
            <div class="register">
                <p>Already have an account? <a href="index.php?page=login">Sign in</a></p>
            </div>
        </form>
    </div>
</body>
</html>
