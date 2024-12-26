<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <link rel="stylesheet" href="../inc/css/adminDash.css">
</head>
<body>
    <div class="wrapper">
        <h1>Manage Users</h1>
        
            
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars($_GET['success']); ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>
        
        <div class="admin-navigation">
            <a href="index.php?page=admin/dashboard">Back to Dashboard</a>
        </div>
        
        <table class="admin-table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                    <td><?php 
                        $status = $user['approval_status'] ?? 'N/A';
                        echo $status === 1 ? 'Approved' : 'Pending'; 
                    ?></td>
                    <td>
                        <a href="index.php?page=admin/delete-user&userId=<?php echo $user['id']; ?>" 
                           onclick="return confirm('Are you sure you want to delete this user?');"
                           class="role-button">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Pending Requests</h2>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pendingUsers as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                    <td>
                        <a href="index.php?page=approve_user&id=<?php echo $user['id']; ?>" class="role-button">Approve</a>
                        <a href="index.php?page=reject_user&id=<?php echo $user['id']; ?>" class="role-button">Reject</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="role-buttons" style="margin-top: 20px; display: none;">
            <a href="index.php?page=admin/dashboard" class="role-button">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
