<?php
$conn = new mysqli("localhost", "root", "", "rating_and_review_database");

if (!$conn) {
    echo "Major Connection Failed" . mysqli_connect_error();
}
