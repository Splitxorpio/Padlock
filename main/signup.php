<?php
include "db.php";
if (isset($_POST['register'])) {
    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $sql = 'select username from users where username=?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($found);
        $stmt->fetch();
        if (!$found) {
            $sql = $conn->prepare("INSERT INTO userstwo (username, password) VALUES (?,?)");
            $sql->bind_param("ss", $username, $password);
            $sql->execute();
            header('location:login.php');
        }else{
            echo "This Username is already taken";
        }
    } else {
        header('location:signup.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../homepage/style.css">
    </link>
    <link rel="stylesheet" href="main.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <!-- Form for creating account -->
    <div class="container">
        <div style="display:none">
            <input type="password" tabindex="-1" />
        </div>
        <form class="formholder" method="POST" action="signup.php">
            <h1 style="padding-top: 25px;">SIGNUP</h1>
            <hr style="width: 50%; margin-top: 5px; margin-bottom: 5px; ">
            <input type="text" name="username" readonly onfocus="this.removeAttribute('readonly');" id="username">
            <input type="password" name="password" readonly onfocus="this.removeAttribute('readonly');" id="password">
            <div class="g-recaptcha" data-sitekey="6LdaYhgcAAAAAOlRvg-fili6zKkmjSZeQwOMjYsg" name="notbot"></div>
            <input type="submit" name="register" value="Sign Up">
            <br>
            <a style="padding-bottom: 20px; color: black;" href="login.php">Already Registered? Login</a>
        </form>
    </div>
</body>

</html>