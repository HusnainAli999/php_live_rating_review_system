<?php
session_start();

include "config.php";

if (isset($_SESSION['logins'])) {

    $userAuth = mysqli_prepare($conn, "SELECT * FROM reviews_table WHERE user_id = ?");
    $userAuth->bind_param("s", $_SESSION['logins']);
    $userAuth->execute();
    $userAuthResult = $userAuth->get_result();

    if ($userAuthResult->num_rows > 0) {
        echo "You Cannot Review Again ";
        exit;
    }

    $review = sanitizeInput($_POST['review']);
    $rating = sanitizeInput($_POST['rating']);
    $user_hidden_id = $_POST['user_hidden_id'];

    if (empty($review) || strlen($review) > 1000) {
        echo "Please provide a review with a maximum of 1000 characters.";
    } else {
        $stmt = $conn->prepare("INSERT INTO reviews_table (name, review, rating, user_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $_SESSION['logins_name'], $review, $rating, $user_hidden_id);

        if ($stmt->execute()) {
            echo "Review submitted successfully.";
        }

        $stmt->close();
    }
} else {
    echo "Please Login First";
}

$conn->close();

function sanitizeInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
