<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback Details</title>
    <link rel="stylesheet" href="../inc/css/adminDash.css">
    <style>
        .feedback-details {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background: rgba(15, 15, 15, 0.8);
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        .feedback-details p {
            margin-bottom: 10px;
        }
        .feedback-details .label {
            font-weight: bold;
            color:white;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="feedback-details">
            <h1>Feedback Details</h1>
            
            <?php if ($feedback): ?>
                <p><span class="label">Feedback ID:</span> <?= htmlspecialchars($feedback['request_id']) ?></p>
                <p><span class="label">Name:</span> <?= htmlspecialchars($feedback['name']) ?></p>
                <p><span class="label">Username:</span> <?= htmlspecialchars($feedback['username']) ?></p>
                <p><span class="label">Email:</span> <?= htmlspecialchars($feedback['email']) ?></p>
                <p><span class="label">Received At:</span> <?= htmlspecialchars($feedback['created_at']) ?></p>
                <p><span class="label">Message:</span></p>
                <div style="background-color: black; padding: 15px; border-radius: 5px; border: 1px solid #ddd;">
                    <?= nl2br(htmlspecialchars($feedback['message'])) ?>
                </div>
            <?php else: ?>
                <p>Feedback not found.</p>
            <?php endif; ?>
            
            <div class="admin-navigation">
                <a href="index.php?page=admin/feedbacks" class="add-to-cart">Back to Feedbacks</a>
            </div>
        </div>
    </div>
</body>
</html>
