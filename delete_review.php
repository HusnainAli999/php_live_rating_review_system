<?php

include "config.php";


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["review_id"])) {
    $reviewId = $_POST["review_id"];
    
    $sql = "DELETE FROM reviews_table WHERE id = $reviewId";
    
    if ($conn->query($sql) === TRUE) {
        echo "Review deleted successfully";
    } else {
        echo "Error deleting review: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>
