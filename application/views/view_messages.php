<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Contact Messages</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date Submitted</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($messages)): ?>
                    <?php foreach ($messages as $message): ?>
                        <tr>
                            <td><?php echo $message['id']; ?></td>
                            <td><?php echo $message['name']; ?></td>
                            <td><?php echo $message['email']; ?></td>
                            <td><?php echo nl2br($message['message']); ?></td>
                            <td><?php echo $message['created_at']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No messages found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
