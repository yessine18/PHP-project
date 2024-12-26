<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Feedbacks</title>
    <link rel="stylesheet" href="../inc/css/adminDash.css">

</head>
<body>
    <div class="admin-container">
        <h1>Manage Feedbacks</h1>
        
        <?php if (empty($feedbacks)): ?>
            <p>No feedback messages found.</p>
        <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Feedback ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Received At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($feedbacks as $feedback): ?>
                    <tr>
                        <td><?= htmlspecialchars($feedback['request_id']) ?></td>
                        <td><?= htmlspecialchars($feedback['name']) ?></td>
                        <td><?= htmlspecialchars($feedback['username']) ?></td>
                        <td><?= htmlspecialchars($feedback['email']) ?></td>
                        <td><?= htmlspecialchars($feedback['created_at']) ?></td>
                        <td>
                            <a href="index.php?page=admin/feedback_details&requestId=<?= $feedback['request_id'] ?>" 
                               class="add-to-cart">View Details</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        
        <div class="role-buttons" style="margin-top: 20px;">
            <a href="index.php?page=admin/dashboard" class="add-to-cart">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
