<?php
include "config.php";
session_start();
include "css.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = mysqli_prepare($conn, "SELECT * FROM registration_table WHERE email = ?");
    $stmt->bind_param("s", $_POST['email']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {
        if (password_verify($_POST['password'], $row['password'])) {
            $_SESSION['logins'] = $row['unique_id'];
            $_SESSION['logins_name'] = $row['name'];
            echo "<h1 class='alert_h1'> You are logged in successfully </h1>";
        } else {
            echo "<h1 class='alert_h1'> Password incorrect </h1>";
            exit;
        }
    } else {
        echo "<h1 class='alert_h1'> Email incorrect </h1>";
        exit;
    }
}
?>
<h1 class="top_h1">Login Form <a class="redirect_a" href="register.php">Register</a> <a class="redirect_a" href="login.php">Login</a> <a class="redirect_a" href="real_rating.php">Index</a> </h1>
<form action="" method="POST" class="form_design">
    <div>
        <label>Email</label><br>
        <input type="email" name="email">
    </div>

    <div>
        <label>Password</label><br>
        <input type="password" name="password">
    </div>

    <div>
        <input type="submit" value="Search">
    </div>
</form>