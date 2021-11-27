<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/18cc79072b.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="title" style="margin-top: 0px;">
            <h1>Padl🔒ck</h1>
            <hr style="margin-top: 10px; margin-bottom: 10px;">
            <p>The Ultimate Password / Personal Info Locker</p>
            <div class="titletwo">
                <a class="signup" href="../main/signup.php">Upgrade your Privacy</a>
                <br>
                <p style="color: white; font-size: 20px; position:absolute; top:0%; left: 0%;">
                    <?php
                    if (isset($_POST['logout'])) {
                        session_start();
                        session_destroy();
                    } else {
                        session_start();
                        if (isset($_SESSION['username'])) {
                            print("Logged in as " . " " . $_SESSION['username']);
                        } else {
                        }
                    }
                    ?>
                </p>
            </div>
            <a class="signup" style="font-size: 15px;" href="about.php">Learn More >>></a>
        </div>
        <br>
        <br>
    </div>
</body>

</html>