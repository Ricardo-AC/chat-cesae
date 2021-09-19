<?php
ob_start();
include('../db/connectionDB.php');
$user = $_POST['form-username'];
$pass = $_POST['form-password'];
$sql = "SELECT idUser,username, password FROM Users WHERE username='$user'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
session_start();
if ($result->num_rows == 1) {
        if ($row['username'] == $user && password_verify($pass, $row['password'])) {
                   
                $_SESSION['username']=$user;
                $_SESSION['idUser']=$row['idUser'];
                $_SESSION['login']="ok";
                header("Location: ../channel_list.php");
                die();
        }
        $_SESSION['login']="password";
        header("Location: ../index.php");
        die();

} else {
    $_SESSION['login']="username";
        header("Location: ../index.php");
        die();
}
$conn->close();
?>
