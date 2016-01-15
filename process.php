<?php
session_start();
$_SESSION['name']=$_POST['name'];
$_SESSION['email']=$_POST['email'];
$_SESSION['comment']=$_POST['comment'];

if(empty($_POST['name'])){
	echo '<script> alert("You did not enter a Display Name!");window.location.href = "index.php";</script>'; die();}
if(empty($_POST['comment'])){
	echo '<script> alert("You did not enter a Message!");window.location.href = "index.php";</script>'; die();}

$name=$_POST['name'];
if(empty($_POST['email'])){$email="N/A";}else{$email=$_POST['email'];}
$comment=$_POST['comment'];

$db_conx= new mysqli("**SERVER**", "**DATABASE**", "**PASSWORD**", "**USERNAME**")or die("cannot connect");
$insert=$db_conx->prepare("INSERT INTO comments (email, name, comment) VALUES (?, ?, ?)");
$insert->bind_param('sss', $email, $name, $comment);
$insert->execute();

session_unset(); 
session_destroy(); 

header('Location:http://www.talenttrend.co.uk/hae');?>
