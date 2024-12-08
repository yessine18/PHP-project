<?php
// Remove session_start() as it's already started in index.php
$error = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astronomy - Login</title>
    <link rel="stylesheet" href="../../public/css/login.css">
</head>
<body>
    <div class="wrapper">
        <form action="../../public/index.php?controller=auth&action=login" method="POST">
            <h2>Sign in to Space</h2>
            
            <?php if (!empty($error)): ?>
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
            <input type="hidden" name="role" id="role" value="user">

            <button type="submit">Login</button>
        </form>
    </div>

    <script>
        function selectRole(role) {
            document.getElementById('role').value = role;
            document.querySelectorAll('.role-button').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
        }
    </script>
</body>
</html>
