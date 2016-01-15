<?php 
session_start();
$uid= (int)$_SESSION['uid'];
if($uid <= 0){echo '<script> alert("Sorry! you need to login! "); window.location.href ="login.html" </script>';exit;}

$id=(int)$_GET['id'];

$db_conx= new mysqli("**SERVER**", "**DATABASE**", "**PASSWORD**", "**USERNAME**")or die("cannot connect");
$idcheck=$db_conx->prepare("SELECT COUNT(*) FROM comments WHERE id=?");
$idcheck->bind_param('i', $id);
$idcheck->execute();
$idcheck->bind_result($nor);
$idcheck->fetch();

if($nor< 1){ echo '<script> alert("Sorry there was an error finding the post!'.$id.' '.$nor.'"); window.location.href ="backend.php" </script>';exit;}

$db_conx= new mysqli("cust-mysql-123-18", "haeass", "asshae", "haeass")or die("cannot connect");
$delid=$db_conx->prepare("DELETE FROM comments WHERE id=?");
$delid->bind_param('i', $id);
if($delid->execute()){
echo '<script> alert("Successfully Deleted!!"); window.location.href ="backend.php" </script>';exit;}else{
echo '<script> alert("Sorry, there was an error!"); window.location.href ="backend.php" </script>';exit;}
?>
