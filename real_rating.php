<?php
session_start();
include "config.php";
include "css.php";
include "real_rating_css.php"; 

?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.4/jquery.rateyo.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

<h1 class="top_h1">Index <a class="redirect_a" href="register.php">Register</a> <a class="redirect_a" href="login.php">Login</a> <a class="redirect_a" href="real_rating.php">Index</a> </h1>
    <div class="rating-container">
        <form method="POST" id="review-form">
            <input type="hidden" name="user_hidden_id" value="<?php if (isset($_SESSION['logins'])) {
                                                                    echo $_SESSION['logins'];
                                                                }  ?>">
            <textarea name="review" id="review-text" placeholder="Your Review" required></textarea><br>
            <span id="read-more" class="read-more-link" style="display: none;">Read More</span>
            <span id="read-less" class="read-less-link" style="display: none;">Read Less</span><br><br>
            <div id="rating"></div><br>
            <input type="hidden" name="rating" id="rating-input" required>
            <input type="submit" name="submit" value="Submit Review">
        </form>
    </div>


    <div id="reviews-container"></div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.4/jquery.rateyo.min.js"></script>
    <script>
        $(document).ready(function() {
            loadReviews(1); // Load initial page

            function loadReviews(page) {
                $.ajax({
                    url: "load_reviews.php",
                    method: "GET",
                    data: {
                        page: page
                    },
                    success: function(data) {
                        $("#reviews-container").html(data);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            }

            $(document).on("click", ".pagination a", function(e) {
                e.preventDefault();
                var page = $(this).attr("href").split("=")[1];
                loadReviews(page);
            });


            $("#review-form").submit(function(event) {
                event.preventDefault(); // Prevent form submission

                var form = $(this);
                var url = form.attr('action');
                var formData = form.serialize();

                $.ajax({
                    type: 'POST',
                    url: 'submit_review.php', // PHP file handling the AJAX request
                    data: formData,
                    success: function(response) {
                        alert(response); // Show the response from the server
                        form.trigger('reset'); // Reset the form
                    },
                    error: function(xhr, status, error) {
                        alert("Error: " + error); // Show an error message
                    }
                });

            });


            // Add event listener for delete buttons
            $(document).on('click', '.delete-review', function() {
                var reviewId = $(this).data('review-id');
                deleteReview(reviewId);
            });

            function deleteReview(reviewId) {
                $.ajax({
                    url: "delete_review.php",
                    method: "POST",
                    data: {
                        review_id: reviewId
                    },
                    success: function(response) {
                        // Reload the reviews after successful deletion
                        loadReviews(1);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            }
        });
    </script>
</body>

</html>