<?php
include("db/connectionDB.php");
require __DIR__ . '/vendor/autoload.php';
session_start();
ob_implicit_flush(true);

$options = array(
  'cluster' => 'eu',
  'useTLS' => true
);
$pusher = new Pusher\Pusher(
  '6c723a6f8599163886eb',
  '7574e30580314e97ec4e',
  '1242538',
  $options
);
if (!empty($_POST)) {

  $idUser = $_SESSION['idUser'];
  $message = $_POST['message'];
  $channel = $_SESSION['channel'];

$target_dir = "user_images/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
if($target_file==$target_dir){
  $target_file="";
}
}
  $sql = "INSERT into Message (idUser, content,idChannel,image_url) VALUES ($idUser, '$message', $channel,'$target_file')";
  $conn->query($sql);

$data['username'] = $_SESSION['username'];
$data['message'] = $_POST['message'];
$data['image_url'] = $target_file;

$channelToken = $_SESSION['channelToken'];
$pusher->trigger($channelToken, 'messages', $data);



$conn->close();
