<?php 
// On failed submissions the form auto re-fills for the posters convience 
// On successful submission PHP Session Ends
session_start();
$name= $_SESSION['name'];
$email= $_SESSION['email'];
$comment=$_SESSION['comment'];?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Web Developer Test</title>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
$(document).ready(function() {
    var text_max = 1000;
    $('#charleft').html(text_max + ' characters remaining');

    $('#comment').keyup(function() {
        var text_length = $('#comment').val().length;
        var text_remaining = text_max - text_length;

        $('#charleft').html(text_remaining + ' characters remaining');
    });
});
</script>
<style>
body{width:80vw;
	margin:2vh auto;
	word-break:break-word;
	border: 1px #e4e4e4 solid;
  	padding: 20px;
  	border-radius: 4px;
  	box-shadow: 0 0 6px #ccc;
  	background-color: #fff;}
form{ width:50vw;
	margin:auto;}
label {
    width:10vw;
    margin-top: 3px;
    display:inline-block;
    float:left;
    padding:3px;}
#email, #name {
    height:20px; 
    width:32vw; 
    padding:5px 8px;}
textarea {padding:8px;
	width:32vw;
	height:40px;}
ul{
	list-style-type:none;}
li{ padding:12px 0;}
tr, td{padding:2vh 0;}
</style>
</head>
<body>
<h1 style="text-align:center;">Welcome To The Guestbook</h1>
<form method="post" action="process.php">
<ul>
<li>
<label for="name">Your Display Name</label>
<input placeholder="Mandatory" type="text" value="<?php echo $name;?>" name="name" id="name" maxlength="50">
</li>
<li>
<label for="email">Your Email</label>
<input placeholder="Optional" type="email" value="<?php echo $email;?>" name="email" id="email" maxlength="254">
</li>
<li>
<label for="comment">Your Message</label>
<textarea placeholder="Mandatory" name="comment" id="comment" maxlength="1000"><?php echo $comment;?></textarea>
<div id="charleft" style="text-align:center;"></div>
</li>
<li style="text-align:center;">
<input id="submit" type="submit" value="Post">
</li>
</ul>
</form>
<hr style="width:75%;">
<table style="width:100%;text-align:center;">
<?php 
date_default_timezone_set("Europe/London");

$db_conx= new mysqli("**SERVER**", "**DATABASE**", "**PASSWORD**", "**USERNAME**")or die("cannot connect");
$getposts=$db_conx->prepare("SELECT tstmp, email, name, comment FROM comments ORDER BY tstmp DESC LIMIT 25");
$getposts->execute(); 
$getposts->bind_result($ts, $email, $name, $comment);
while($getposts->fetch()){
	
$ts= date("d/m/Y",strtotime($ts))."<br>".date("H:i",strtotime($ts));;
echo "<tr><td style='width:20%;'>".$name."</td><td style='width:60%;'>".$comment."</td><td style='width:20%;'>".$ts."</td><tr>";
}
?>
</table>
</body>
</html>
