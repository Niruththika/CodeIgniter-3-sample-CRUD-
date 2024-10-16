<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Reviews</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Light background color */
            padding: 20px; /* Padding around the body */
        }
        .reviews-container {
            max-width: 800px; /* Maximum width for the reviews section */
            margin: auto; /* Center the reviews section */
            background-color: #ffffff; /* White background for the reviews */
            border-radius: 8px; /* Rounded corners */
            padding: 30px; /* Padding inside the reviews section */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        .review-item {
            margin-bottom: 20px; /* Space between reviews */
            border-bottom: 1px solid #eaeaea; /* Divider line */
            padding-bottom: 20px; /* Padding below each review */
        }
        .review-item:last-child {
            border-bottom: none; /* Remove the last divider */
        }
        .review-title {
            font-weight: bold; /* Bold title */
            font-size: 1.5rem; /* Larger font size for titles */
        }
        .review-rating {
            color: #ffc107; /* Gold color for ratings */
        }
        .review-description {
            margin: 10px 0; /* Margin around description */
        }
        .review-image {
            max-width: 100%; /* Responsive image */
            height: auto; /* Maintain aspect ratio */
            margin-top: 10px; /* Space above the image */
            border-radius: 8px; /* Rounded corners for images */
        }
        video {
            max-width: 100%; /* Responsive video */
            border-radius: 8px; /* Rounded corners for videos */
            margin-top: 10px; /* Space above the video */
        }
        .no-reviews {
            text-align: center; /* Center text for no reviews message */
            font-style: italic; /* Italic for style */
        }
    </style>
</head>
<body>

<div class="reviews-container">
    <h2 class="my-4">Product Reviews</h2>

    <?php if (!empty($reviews)) : ?>
        <?php foreach ($reviews as $review) : ?>
            <div class="review-item">
                <h3 class="review-title"><?php echo $review['title']; ?> <span class="review-rating">(Rating: <?php echo $review['rating']; ?>)</span></h3>
                <p class="review-description"><?php echo $review['description']; ?></p>
                <?php if (!empty($review['image'])) : ?>
                    <img class="review-image" src="<?php echo base_url('uploads/' . $review['image']); ?>" alt="Review Image">
                <?php endif; ?>
                <?php if (!empty($review['video'])) : ?>
                    <video controls>
                        <source src="<?php echo base_url('uploads/' . $review['video']); ?>" type="video/mp4">
                    </video>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p class="no-reviews">No reviews yet. Be the first to review!</p>
    <?php endif; ?>
</div>

<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
