<?php

include "config.php";


$delete = mysqli_prepare($conn, "DELETE FROM reviews_table WHERE id = ?");
$delete->bind_param("i", $_POST['review_delete_id']);
$delete->execute();
$delete->close();
$conn->close();

?>