<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../inc/css/SignIn.css">
    <script>
        function selectRole(role) {
            var buttons = document.getElementsByClassName('role-button');
            for (var i = 0; i < buttons.length; i++) {
                buttons[i].classList.remove('active');
            }
            event.target.classList.add('active');
            
            // Add a hidden input to send the selected role
            var hiddenInput = document.getElementById('login_type');
            if (!hiddenInput) {
                hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.id = 'login_type';
                hiddenInput.name = 'login_type';
                document.querySelector('form').appendChild(hiddenInput);
            }
            hiddenInput.value = role;
        }

        // Ensure a role is selected by default
        window.onload = function() {
            selectRole('user');
        }
    </script>
</head>
<body>
    <div class="wrapper">
        <form action="index.php?page=authenticate" method="POST">
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
                <button type="button" class="role-button" onclick="selectRole('user')">User</button>
                <button type="button" class="role-button active" onclick="selectRole('admin')">Admin</button>
            </div>
            <button type="submit">Sign In</button>
            <div class="register">
                <p>Don't have an account? <a href="index.php?page=signup">Sign up</a></p>
            </div>
        </form>
    </div>
</body>
</html>
