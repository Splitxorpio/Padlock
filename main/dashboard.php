<?php
session_start();
include 'db.php';
if (isset($_POST['register'])) {
    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];       
        $resultone = $conn->prepare("SELECT * FROM users WHERE username = ? and password = ? LIMIT 1");
        $resultone->bind_param("ss", $username, $password);
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $resultone -> execute();
        $result = $resultone->get_result();
        $row = $result->fetch_assoc();
        $_SESSION['id'] = $row['id'];
        $iduser = $_SESSION['id'];
        if ($row['username'] == $username && $row['password'] == $password) {
            if ($row['admin'] == 1){
                header('location: admin.php');
            }
            if ($row['ban'] != 0){
                header('location: ban.php');
            }
        } else {
            header('location: login.php');
        }
        $login_time = date("Y-m-d h:i:sa", $d);
        $sql = "INSERT INTO login_times (date, user) VALUES ('$login_time','$username')";
        mysqli_query($conn, $sql);
    }else{
        header('location: login.php');
    }

}
if (isset($_POST['accdelete'])) {
    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        $username = mysqli_real_escape_string($conn, $_SESSION['username']);
        $delete = mysqli_query($conn, "DELETE FROM posts where user = '$username'");
        $delettwo = mysqli_query($conn, "DELETE FROM login_times where user='$username'");
        $result = mysqli_query($conn, "DELETE FROM users where username ='$username'");
        session_destroy();
        header('location: signup.php');
    }
    else{
        header('location:delete.php');
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
</head>

<body>
    <!-- Account Dashboard -->
    <div class="formholdercon">
        <img style="width: 55px; height: 55px; border-radius: 100px; border: 2px solid #E66677; padding: 5px;" src="https://avatars.dicebear.com/api/bottts/<?php echo $_SESSION['username'] ?>.svg" alt="" />
        <h1 style="font-size: 25px;"><?php echo $_SESSION['username'] ?></h1>
        <hr style="width: 50%; margin-top: 5px; margin-bottom: 5px; ">
        <form action="../homepage/index.php" method="POST">
            <input type="submit" name="logout" value="Sign Out!">
        </form>
        <a style="color:red;" href="delete.php">Delete Account</a>
    </div>
    <div class="container">
        <div class="main">
            <hr style="margin-bottom: 5px;">
            <form method="POST" action="dashboard.php">
                <input type="password" name="post" placeholder="Add a new password!">
                <input type="text" name="type" placeholder="What is the Password for?">
                <input type="submit" name="registertwo">
            </form>
            <!-- Add a password here -->
            <h1>
                <?php
                if (isset($_POST['registertwo'])) {
                    $post = $_POST['post'];
                    $username = mysqli_real_escape_string($conn, $_SESSION['username']);
                    $type = $_POST['type'];
                    $sql = "INSERT INTO posts (post, type, user) VALUES ('$post', '$type', '$username')";
                    mysqli_query($conn, $sql);
                    $result = mysqli_query($conn, "SELECT * FROM posts WHERE post='$post'");
                    $row = mysqli_fetch_assoc($result);
                    $dots = '';
                    for ($i = 0; $i < strlen($post); $i++) {
                        $dots = $dots . '*';
                    }
                    echo "<samp>>> " . $dots . " has been added as id " . $row['id'] . "! Make sure to remember this when looking for your information!</samp>";
                }
                ?>
            </h1>
            <!-- Search for passwords here -->
            <hr style="margin-bottom: 5px;">
            <form action="dashboard.php" method="post">
                <input style="width: 30%;" type="password" name="q" placeholder="Find your password! (Remember your ID!)">
                <input type="submit" name="go">
            </form>
            <h1>
                <?php
                if (isset($_POST['go'])) {
                    $safe_value = mysqli_real_escape_string($conn, $_POST['q']);
                    $username = mysqli_real_escape_string($conn, $_SESSION['username']);
                    $myArray = array();
                    $result = mysqli_query($conn, "SELECT * FROM posts WHERE id LIKE '$safe_value' and user ='$username'");
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['id'] == null) {
                            echo "Invalid ID";
                        }
                        echo "<div id='" . $row['id'] . "'><samp>" . ">> " . "ID " . $row['id'] . ": " . $row['post'] . ", For: " . $row['type'] . "</samp></div>";
                    }
                }
                ?>
            </h1>
            <!-- Delete Passwords here -->
            <hr style="margin-bottom: 5px;">
            <form action="dashboard.php" method="post">
                <input type="text" name="id" placeholder="Delete your password!">
                <input type="submit" name="delete">
            </form>
            <h1>
                <?php
                if (isset($_POST['delete'])) {
                    $safe_value = mysqli_real_escape_string($conn, $_POST['id']);
                    $username = mysqli_real_escape_string($conn, $_SESSION['username']);
                    $myArray = array();
                    $result = mysqli_query($conn, "DELETE FROM posts WHERE id LIKE '$safe_value' and user ='$username'");
                    echo "<samp>>> ID " . $_POST['id'] . " successfully deleted!</samp>";
                }
                ?>
            </h1>
            <hr style="margin-bottom: 5px;">
            <!-- Shows Recent Login Times -->
            <h1>Recent Login Times:</h1>
            <ol style="margin-left: 15px;">
            <?php
                $result = mysqli_query($conn, "SELECT * FROM login_times WHERE user = '$username'");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>".$row['date']." (UTC-10)‎</li>";
                }
            ?>
            </ol>
        </div>
    </div>

</body>

</html>