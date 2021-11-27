<?php
include "db.php";
if (isset($_POST['register'])) {
    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        $sql = 'select username from users where username=?';
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($found);
        $stmt->fetch();
        if (!$found){
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $sql = $conn->prepare("INSERT INTO users (username, password) VALUES (?,?)");
            $sql->bind_param("ss", $username, $password);
            $sql->execute();
            header('location:login.php');
        }
    }else{
        header('location:signup.php');
    }
}
?>
<!-- Updates Database with the new account credentials -->