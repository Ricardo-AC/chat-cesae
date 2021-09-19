<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
include("db/connectionDB.php");

$idUser = $_SESSION['idUser'];
$channel = $_GET['c'];
$sql = 'SELECT * FROM ChannelUser 
INNER JOIN Channel
ON ChannelUser.idChannel = Channel.idChannel
WHERE ChannelUser.idUser=' . $idUser . ' AND ChannelUser.idChannel=' . $channel;
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    if ($row['active'] == 0) {
        header("Location: channel_list.php");
        exit();
    }
}else {
    header("Location: channel_list.php");
        exit();
    }
$_SESSION['channel']=$_GET['c'];
$_SESSION['channelToken']=$row['channelToken'];
$channelToken="'".$row['channelToken']."'";
$_SESSION['channelName']=$row['name'];
$channelName=$row['name'];
include('templates/top_template.php');
include('components/navbar.php');
include('components/sidebar.php');
include('components/message_box.php');
echo "<script> let mychannel=".$channelToken."</script>";
echo "<script> let myNotificationChannel="."1"."</script>";
echo '<script src="js/channel.js"></script>';
include('templates/bottom_template.php');
?>