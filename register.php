<?php
include "config.php";
include "css.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {

    $unique_id = uniqid();
    $random_bytes = random_bytes(8);
    $unique_id .= bin2hex($random_bytes);

    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = mysqli_prepare($conn, "INSERT INTO registration_table (name, email, password, unique_id) VALUES (?, ?, ?, ?) ");
    $stmt->bind_param("ssss", $_POST['name'], $_POST['email'], $password, $unique_id);
    if ($stmt->execute()) {
        echo "<h1 class='alert_h1'> You Register Successfully. </h1>";
    } else {
        echo "<h1 class='alert_h1'> Registration Failed.</h1>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1 class="top_h1">Register Form <a class="redirect_a" href="register.php">Register</a> <a class="redirect_a" href="login.php">Login</a> <a class="redirect_a" href="real_rating.php">Index</a></h1>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="form_design">
        <div>
            <label>Name</label><br>
            <input type="text" name="name">
        </div>
        <div>
            <label>Email</label><br>
            <input type="email" name="email">
        </div>
        <div>
            <label>Password</label><br>
            <input type="password" name="password">
        </div>
        <div>
            <input type="submit" value="Register" name="register">
        </div>
    </form>
</body>

</html>