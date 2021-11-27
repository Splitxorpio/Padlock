<?php
session_start();
$user = $_SESSION['username'];
require "db.php";
$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$user'");
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['username'] ?> is banned</title>
    <link rel="stylesheet" href="../homepage/style.css">
    </link>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <div class="container">
        <div class="formholder">
            <h1>Hello <?php echo $_SESSION['username'] ?>.</h1>
            <hr>
            <p>We are sorry to inform you that your account has been banned 
            for the following reason:</p>
            <br>
            <p>- <?php echo $row['reason'] ?></p>
            <br>
            <p>You can request a ban appeal <strong>if eligible</strong> 
            <a href="#">here</a></p>
            <br>
            <form action="../homepage/index.php" method="POST">
                <input type="submit" name="logout" value="Go Back :)">
            </form>
        </div>
    </div>

</body>

</html>