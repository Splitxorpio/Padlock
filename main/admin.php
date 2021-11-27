<?php
session_start();
include 'db.php';
$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
$row = mysqli_fetch_assoc($result);
if ($row['admin'] == 1) {
    $_SESSION['valid'] = true;
    $_SESSION['timeout'] = time();
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
} else {
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <?php echo $username . ",  " . "welcome to admin portal!" ?>
    <br>
    <hr>
    <div class="container">
        <div class="holder">
            <P>Sorted by Alphabetical Order..</P>
            <hr>
            <br>
            <p><strong>Admins:</strong></p>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM users WHERE admin = 1 ORDER BY username ASC");
            while ($row = mysqli_fetch_assoc($result)) {
                echo $row['username'] . "(ADMIN) <br>";
            }
            ?>
            <br>
            <hr>
            <br>
            <p><strong>Unbanned Users:</strong></p>
            <ul>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM users WHERE ban < 1 and admin = 0 ORDER BY username ASC");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo $row['username'] . "<br>";
                }
                ?>
            </ul>
            <br>
            <hr>
            <br>
            <p><strong>Banned Users:</strong></p>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM users WHERE ban >= 1 ORDER BY username ASC");
            while ($row = mysqli_fetch_assoc($result)) {
                echo $row['username'] . " (BANNED) <br>";
            }
            ?>
        </div>
        <br>
        <form action="admin.php" method="POST">
            <input type="text" name="ban" placeholder="Ban a user">
            <input type="text" name="reason" placeholder="Reason for Ban">
            <input type="submit" name="bansubmit">
        </form>
        <?php
        if (isset($_POST['bansubmit'])) {
            $username = $_SESSION['username'];
            $username_banned = $_POST['ban'];
            $reason = $_POST['reason'];
            $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username_banned'");
            $row = mysqli_fetch_assoc($result);
            if ($row['admin'] == 1) {
                echo "You cannot ban an admin member.";
            } else {
                $row['ban'] += 1;
                $banned = $row['ban'];
                $result = mysqli_query($conn, "UPDATE users SET ban = ban + 1 WHERE username = '$username_banned'");
                $result = mysqli_query($conn, "UPDATE users SET reason = '$reason' WHERE username = '$username_banned'");
                echo $username_banned." has been banned.";
            }
        }
        ?>
    </div>

</body>

</html>