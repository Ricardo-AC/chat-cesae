<?php
include("db/connectionDB.php");
session_start();
if (isset($_SESSION['user1']) && isset($_SESSION['user2'])) {
    $user1 = $_SESSION['user1'];
    $user2 = $_SESSION['user2'];
    unset($_SESSION['user1']);
} else if (isset($_POST["user1"]) && isset($_POST["user2"])){
    $user1 = $_POST["user1"];
    $user2 = $_POST["user2"];
     $_SESSION['user2']=$user2;
} else{
    echo 'error';
   
}

if ($user1 < $user2) {
    $channel = strval($user1 . $user2);
} else {
    $channel = strval($user2 . $user1);
}

$sql = "SELECT * FROM Channel WHERE name=$channel";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $id = $row['idChannel'];

    header("Location: /channel.php?c=$id");
} else {
    $token = hash('md5', $channel);
    $sql = "INSERT INTO Channel (name, channelToken) VALUES ('$channel','$token')";
    $conn->query($sql);

    $sql = "SELECT * FROM Channel WHERE name=$channel";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $idChannel = $row['idChannel'];

    $sql = "INSERT INTO ChannelUser (idUser, idChannel,active) VALUES ('$user1','$idChannel',1)";
    $conn->query($sql);
    $sql = "INSERT INTO ChannelUser (idUser, idChannel,active) VALUES ('$user2','$idChannel',1)";
    $conn->query($sql);


    $_SESSION['user1'] = $user1;
    $_SESSION['user2'] = $user2;

    header('Location: create_or_go_to_channel.php');
}

$conn->close();
