<?php
$db_conx= new mysqli("**SERVER**", "**DATABASE**", "**PASSWORD**", "**USERNAME**")or die("cannot connect");
$emailcheck=$db_conx->prepare("SELECT id, password FROM users WHERE username=?");
$emailcheck->bind_param('s', $_POST['username']);
$emailcheck->execute();
$emailcheck->bind_result($uid, $hdpsswrd);
$emailcheck->fetch();

if (!password_verify($_POST['password'], $hdpsswrd)) { echo '<script> alert("Login Unsuccessful!"); window.location.href ="login.html" </script>';exit;}

session_start();
$_SESSION['uid']=$uid;

header('Location:http://www.talenttrend.co.uk/hae/backend.php');
?>
