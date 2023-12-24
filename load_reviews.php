<?php
session_start();

include "config.php";
include "real_rating_css.php";


$totalRating = 0; // Variable to store the total ratings

$reviewsPerPage = 5;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($currentPage - 1) * $reviewsPerPage; // Calculate the offset

$sql = "SELECT id, name, review, rating FROM reviews_table LIMIT $reviewsPerPage OFFSET $offset";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviewText = $row['review'];
        if (strlen($reviewText) > 100) {
            $reviewText = substr($reviewText, 0, 100) . '...';

            echo "<p class='giver_name'><strong>Name:</strong> " . $row['name'] . "</p>";
            echo "<div class='rating' data-rating='" . $row['rating'] . "'></div>";

            echo "<br>";
            echo "<p> <button class='update_for_reviews' name='update_for_reviews' data-update-for-reviews= '" . $row['id'] . "'> Update </button> </p>";
            echo "<form method='POST' class='delete_review_form'>";
            echo "<input type='hidden' value='" . $row['id'] . "' name='review_delete_id'>";
            echo "<p> <button type='submit' class='delete_for_reviews' name='delete_for_reviews' data-delete-for-reviews= '" . $row['id'] . "'> Delete </button> </p>";
            echo "</form>";
            echo "<form method='POST' class='update_review_form'> ";
            echo "<input type='hidden' name='update_review_id' value='" . $row['id'] . "' />";
            echo "<textarea name='update_review_message'>" . $row['review'] . "</textarea>";
            echo "<button type='submit' name='update_review' data-id='" . $row['id'] . "' value='" . $row['id'] . "'>Update " . $row['id'] . "</button>";
            echo "</form>";
            echo "<p class='review'><strong>Review:</strong> <span id='reviewText'>" . $reviewText . "</span><span id='readMore' class='read_more' style='display: none;'>" . $row['review'] . "</span><a href='javascript:void(0);' id='readMoreLink'>Read More</a></p>";
        } else {
            echo "<p class='giver_name'><strong>Name:</strong> " . $row['name'] . "</p>";

            echo "<div class='rating' data-rating='" . $row['rating'] . "'></div>";

            echo "<br>";
            $update_del_query = mysqli_query($conn, "SELECT * FROM reviews_table WHERE id = '" . $row['id'] . "' AND user_id = '" . @$_SESSION['logins'] . "' ");


            while ($update_del_query_row = mysqli_fetch_assoc($update_del_query)) {

                if ($_SESSION['logins'] === $update_del_query_row['user_id']) {
                    echo "<p style='display:inline-block;'> <button class='update_for_reviews' name='update_for_reviews' data-update-for-reviews= '" . $update_del_query_row['id'] . "'> Update </button> </p>";
                }
                echo "<form method='POST' class='delete_review_form'>";
                echo "<input type='hidden' value='" . $update_del_query_row['id'] . "' name='review_delete_id'>";
                echo "<p> <button type='submit' class='delete_for_reviews' name='delete_for_reviews' data-delete-for-reviews= '" . $update_del_query_row['id'] . "'> Delete </button> </p>";
                echo "</form>";
                echo "<form method='POST' class='update_review_form'>";
                echo "<input type='hidden' name='update_review_id' value='" . $update_del_query_row['id'] . "' />";
                echo "<textarea name='update_review_message'>" . $update_del_query_row['review'] . "</textarea>";
                echo "<button type='submit' name='update_review' data-id='" . $update_del_query_row['id'] . "' value='" . $update_del_query_row['id'] . "'>Update " . $update_del_query_row['id'] . "</button>";
                echo "</form>";
            }

            echo "<p class='review' class='read_more'><strong>Review:</strong> " . $row['review'] . "</p>";
        }


        $totalRating += $row['rating']; // Calculate the total ratings
    }

    // Calculate the total number of pages
    $totalReviews = $conn->query("SELECT COUNT(*) AS total FROM reviews_table")->fetch_assoc()['total'];
    $totalPages = ceil($totalReviews / $reviewsPerPage);

    // Output the pagination links
    echo "<div class='pagination'>";
    if ($currentPage > 1) {
        echo "<a href='?page=" . ($currentPage - 1) . "' class='previous_a'>&laquo; Previous</a>";
    }
    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<a href='?page=$i' class='pagination_counting_a'>$i</a>";
    }
    if ($currentPage < $totalPages) {
        echo "<a href='?page=" . ($currentPage + 1) . "' class='next_a'>Next &raquo;</a>";
    }
    echo "</div>";

    if ($totalReviews > 0) {

        $averageRating = $totalRating / $totalReviews;
        echo "<div class='total_rating_reviews_joint_div'>";
        echo "<p class='total_reviews'><strong>Total Reviews</strong> " . $totalReviews . "</p>";
        echo "<p><strong>Average Rating:</strong> " . round($averageRating, 2) . "</p>";
        echo "</div>";
    }


    $rating1 = mysqli_prepare($conn, "SELECT rating FROM reviews_table WHERE rating BETWEEN 1 AND 1.50");
    $rating1->execute();
    $result1 = $rating1->get_result();
    $numRows1 = mysqli_num_rows($result1);
    $rating1->close();

    $rating2 = mysqli_prepare($conn, "SELECT rating FROM reviews_table WHERE rating BETWEEN 1.51 AND 2.50");
    $rating2->execute();
    $result2 = $rating2->get_result();
    $numRows2 = mysqli_num_rows($result2);
    $rating2->close();

    $rating3 = mysqli_prepare($conn, "SELECT rating FROM reviews_table WHERE rating BETWEEN 2.51 AND 3.50");
    $rating3->execute();
    $result3 = $rating3->get_result();
    $numRows3 = mysqli_num_rows($result3);
    $rating3->close();

    $rating4 = mysqli_prepare($conn, "SELECT rating FROM reviews_table WHERE rating BETWEEN 3.51 AND 4.50");
    $rating4->execute();
    $result4 = $rating4->get_result();
    $numRows4 = mysqli_num_rows($result4);
    $rating4->close();

    $rating5 = mysqli_prepare($conn, "SELECT rating FROM reviews_table WHERE rating BETWEEN 4.51 AND 5.00");
    $rating5->execute();
    $result5 = $rating5->get_result();
    $numRows5 = mysqli_num_rows($result5);
    $rating5->close();
?>
    <div class="rating1 same_rating_div"></div> <span class='same_rating_div_span'><?php echo $numRows1;  ?></span><br>
    <div class="rating2 same_rating_div"></div> <span class='same_rating_div_span'><?php echo $numRows2;  ?></span> <br>
    <div class="rating3 same_rating_div"></div> <span class='same_rating_div_span'><?php echo $numRows3;  ?></span><br>
    <div class="rating4 same_rating_div"></div> <span class='same_rating_div_span'><?php echo $numRows4;  ?></span><br>
    <div class="rating5 same_rating_div"></div> <span class='same_rating_div_span'><?php echo $numRows5;  ?></span>
<?php


} else {
    echo "<p class='no_review_p'>No reviews found. <img src='images/night.png'></p>";
}

$conn->close();
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.4/jquery.rateyo.min.js"></script>

<script>
    var update_for_reviews = document.querySelectorAll(".update_for_reviews");
    var update_review_form = document.querySelectorAll(".update_review_form");

    for (let i = 0; i < update_for_reviews.length; i++) {
        update_for_reviews[i].addEventListener("click", () => {
            if (update_review_form[i].style.display === "none") {
                update_review_form[i].style.display = "block";
            } else {
                update_review_form[i].style.display = "none";
            }
        });
    }


    $('.delete-review').click(function() {
        var reviewId = $(this).data('review-id');
        if (confirm("Are you sure you want to delete this review?")) {
            $.ajax({
                url: 'delete_review.php',
                method: 'POST',
                data: {
                    review_id: reviewId
                },
                success: function(response) {
                    alert(response);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });

    // Delete reply
    $('.delete-reply').click(function() {
        var replyId = $(this).data('reply-id');
        if (confirm("Are you sure you want to delete this reply?")) {
            $.ajax({
                url: 'delete_reply.php',
                method: 'POST',
                data: {
                    reply_id: replyId
                },
                success: function(response) {
                    alert(response);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });

    $(document).ready(function() {
        $("#rating").rateYo({
            rating: 0,
            numStars: 5,
            precision: 1,
            minValue: 0,
            maxValue: 5,
            onChange: function(rating, rateYoInstance) {
                $("#rating-input").val(rating);
            }
        });

    })
</script>

<script>
    $(document).ready(function() {
        $('.rating').each(function() {
            var rating = $(this).data('rating');
            $(this).rateYo({
                rating: rating,
                readOnly: true,
                numStars: 5,
                precision: 1,
                minValue: 0,
                maxValue: 5,
                starWidth: "20px",
                spacing: "2px"
            });
        });
    });

    $(document).ready(function() {
        $('.rating1').each(function() {
            var rating = $(this).data('rating') || 1;
            $(this).rateYo({
                rating: rating,
                readOnly: true,
                numStars: 5,
                precision: 1,
                minValue: 0,
                maxValue: 5,
                starWidth: "30px",
                spacing: "2px"
            });
        });
    });

    $(document).ready(function() {
        $('.rating2').each(function() {
            var rating = $(this).data('rating') || 2;
            $(this).rateYo({
                rating: rating,
                readOnly: true,
                numStars: 5,
                precision: 1,
                minValue: 0,
                maxValue: 5,
                starWidth: "30px",
                spacing: "2px"
            });
        });
    });

    $(document).ready(function() {
        $('.rating3').each(function() {
            var rating = $(this).data('rating') || 3;
            $(this).rateYo({
                rating: rating,
                readOnly: true,
                numStars: 5,
                precision: 1,
                minValue: 0,
                maxValue: 5,
                starWidth: "30px",
                spacing: "2px"
            });
        });
    });

    $(document).ready(function() {
        $('.rating4').each(function() {
            var rating = $(this).data('rating') || 4;
            $(this).rateYo({
                rating: rating,
                readOnly: true,
                numStars: 5,
                precision: 1,
                minValue: 0,
                maxValue: 5,
                starWidth: "30px",
                spacing: "2px"
            });
        });
    });

    $(document).ready(function() {
        $('.rating5').each(function() {
            var rating = $(this).data('rating') || 5;
            $(this).rateYo({
                rating: rating,
                readOnly: true,
                numStars: 5,
                precision: 1,
                minValue: 0,
                maxValue: 5,
                starWidth: "30px",
                spacing: "2px"
            });
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('.pagination_counting_a').on('click', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('=')[1];
            loadReviews(page);
        });

        function loadReviews(page) {
            $.ajax({
                url: 'load_reviews.php?page=' + page,
                type: 'GET',
                success: function(response) {
                    $('#reviews-container').html(response);
                },
                error: function(xhr, status, error) {
                    alert("Error: " + error); // Show an error message
                }
            });
        }
    });
</script>

<script>
    $(document).ready(function() {
        $(document).on("click", "#readMoreLink", function() {
            var readMoreLink = $(this);
            var reviewText = readMoreLink.siblings("#reviewText");
            var fullReview = readMoreLink.siblings("#readMore");

            if (readMoreLink.text() === "Read More") {
                reviewText.text(fullReview.text());
                readMoreLink.text("Read Less");
            } else {
                reviewText.text(fullReview.text().substr(0, 100) + "...");
                readMoreLink.text("Read More");
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(".update_review_form").submit(function(event) {
            event.preventDefault();
            var form = $(this);
            $.ajax({
                url: "update_review.php",
                type: "POST",
                data: form.serialize(),
                success: function(response) {
                    $(".read_more").html(response);
                },
                error: function() {
                    alert("An error occurred while updating the review!");
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".delete_review_form").submit(function(event) {
            event.preventDefault();
            var form = $(this);
            $.ajax({
                url: "delete_user_review.php",
                type: "POST",
                data: form.serialize(),
                success: function() {
                    alert("Your Review Successfully Delete!");
                },
                error: function() {
                    alert("An error occurred while delete the review!");
                }
            });
        });
    });
</script>