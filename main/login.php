<?php
include "db.php";
session_start();

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
    <div class="container">
        <!-- Form for login -->
        <div style="display:none">
            <input type="password" tabindex="-1" />
        </div>
        <form class="formholder" method="POST" action="dashboard.php">
            <h1 style="padding-top: 25px;">
                <?php
                if (isset($_POST['registertwo'])) {
                    echo "Login Again";
                } else {
                    echo "Login";
                }
                ?>
            </h1>
            <hr style="width: 50%; margin-top: 5px; margin-bottom: 5px; ">
            <input type="text" name="username" readonly onfocus="this.removeAttribute('readonly');" id="username">
            <input type="password" name="password" readonly onfocus="this.removeAttribute('readonly');" id="password">
            <div class="g-recaptcha" data-sitekey="6LdaYhgcAAAAAOlRvg-fili6zKkmjSZeQwOMjYsg" name="notbot"></div>
            <input name="register" type="submit" value="Log In">
            <a href="signup.php" style="color: black;">Don't have an account? Sign Up here</a>
        </form>
    </div>
</body>

</html>