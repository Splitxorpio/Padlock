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
    <!-- Account deleting confirmation -->
    <div class="container">
        <form action="dashboard.php" method="POST" class="formholdercon" style="left: 15%; top: 25%; border-radius: 50px;">
            <h1>Are you sure you wish to delete your account? This is not reversable!</h1>
            <div class="g-recaptcha" data-sitekey="*" name="notbot"></div>
            <input type="submit" name="accdelete" value="Delete Account">
        </form>
    </div>
</body>

</html>
