<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../inc/css/login.css">
</head>
<body>
<div class="wrapper">
    <form action="index.php?page=application" method="POST">
        <h2>Join the Astronomy Community</h2>
        
        <?php if (!empty($error)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <!-- User Full Name -->
        <div class="input-field">
            <input type="text" name="full_name" required>
            <label>Full Name</label>
        </div>
        
        <!-- Email Input -->
        <div class="input-field">
            <input type="email" name="email" required>
            <label>Email Address</label>
        </div>
        
        <!-- Role Selection -->
        <div class="role-buttons">
            <p>Select Your Role:</p>
            <button type="button" class="role-button active" onclick="selectRole('member')">Member</button>
            <button type="button" class="role-button" onclick="selectRole('admin')">Administrator</button>
        </div>

        <!-- Interests Section -->
        <div class="input-field">
            <input type="text" rows="4" name="interests" required>
            <label>Share your astronomy-related interests with us</label>
        </div>
        
        <!-- Submit -->
        <button type="submit" class="submit-btn">Join the Community</button>
        
        <div class="register">
            <p>Already a member? <a href="index.php?page=CommunityLogin">Login here</a></p>
        </div>
    </form>
</div>

<script>
    let selectedRole = 'member';

    function selectRole(role) {
        selectedRole = role;
        const buttons = document.querySelectorAll('.role-button');
        buttons.forEach(button => {
            button.classList.remove('active');
        });
        event.target.classList.add('active');
    }
</script>

</body>
</html>
