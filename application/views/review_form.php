<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Your Review</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Light background color */
            padding: 20px; /* Padding around the body */
        }
        .container {
            max-width: 600px; /* Maximum width of the form */
            margin: auto; /* Center the form on the page */
            background-color: #ffffff; /* White background for the form */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            padding: 30px; /* Padding inside the form */
        }
        .form-group label {
            font-weight: bold; /* Bold labels */
        }
        .btn-primary {
            background-color: #007bff; /* Primary button color */
            border-color: #007bff; /* Border color */
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Darker color on hover */
            border-color: #0056b3; /* Darker border on hover */
        }
        .needs-validation .form-control:valid {
            border-color: #28a745; /* Green border for valid inputs */
        }
        .needs-validation .form-control:invalid {
            border-color: #dc3545; /* Red border for invalid inputs */
        }
        .form-control-file {
            border: 1px solid #ced4da; /* Border for file inputs */
            border-radius: 0.25rem; /* Rounded corners for file inputs */
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="my-4">Submit Your Review</h2>

    <?php echo validation_errors(); ?>

    <?php echo form_open_multipart('review/store', ['class' => 'needs-validation', 'novalidate' => '']); ?>

    <div class="form-group">
        <label for="rating">Rating (1-5):</label>
        <input type="number" class="form-control" name="rating" min="1" max="5" required>
    </div>

    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" name="title" required>
    </div>

    <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" name="description" required></textarea>
    </div>

    <div class="form-group">
        <label for="image">Upload Image (optional):</label>
        <input type="file" class="form-control-file" name="image">
    </div>

    <div class="form-group">
        <label for="video">Upload Video (optional):</label>
        <input type="file" class="form-control-file" name="video">
    </div>

    <button type="submit" class="btn btn-primary">Submit Review</button>

    <?php echo form_close(); ?>
</div>

<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
