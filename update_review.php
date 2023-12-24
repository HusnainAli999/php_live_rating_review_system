<?php
include "config.php";

$update_for_reviews = mysqli_prepare($conn, "UPDATE reviews_table SET review = ? WHERE id = ?");
$update_for_reviews->bind_param("si", $_POST['update_review_message'], $_POST['update_review_id']);

if ($update_for_reviews->execute()) {
    echo json_encode($_POST['update_review_message']);
}
$update_for_reviews->close();

$conn->close();
