<?php 
include('../includes/db_connect.php');

$usr = $_POST['usuario'];
$stt = $_POST['estado'];

$stt = ($stt == 1 ? 0 : 1);

$query = $mysqli->prepare("UPDATE usuarios SET user_validate = ? WHERE user_id = ?");
$query->bind_param('ii', $stt, $usr);
$query->execute();
$query->close();
$mysqli->close();

echo $stt;
?>