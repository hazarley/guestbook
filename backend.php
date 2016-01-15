<?php 
session_start();
$uid= (int)$_SESSION['uid'];
if($uid <= 0){echo '<script> alert("Sorry! you need to login! "); window.location.href ="login.html" </script>';exit;}?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Web Developer Test</title>
<style>
body{width:90vw;
	margin:2vh auto;
	word-break:break-word;}
</style>
</head>
<body>
<a href="index.php">Back to the main site</a><br>
<a href="logout.php">Logout</a>
<table border="1" style="width:100%;text-align:center; border-collapse:collapse;">
<tr>
<th style='width:14%;'>Visitor Name</th>
<th style='width:14%;'>Email</th>
<th style='width:51%;'>Message</th>
<th style='width:13%;'>Time</th>
<th style='width:8%;'></th>
</tr>
<?php 
date_default_timezone_set("Europe/London");
function humanTiming ($ts)
{
    $time = time() - strtotime($ts);
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }

}

$db_conx= new mysqli("**SERVER**", "**DATABASE**", "**PASSWORD**", "**USERNAME**")or die("cannot connect");
$getposts=$db_conx->prepare("SELECT id, tstmp, email, name, comment FROM comments ORDER BY tstmp DESC");
$getposts->execute(); 
$getposts->bind_result($id, $ts, $email, $name, $comment);
while($getposts->fetch()){

$ago=humanTiming($ts).' ago';
	
$ts= date("d/m/Y",strtotime($ts))."<br>".date("H:i",strtotime($ts));
?><tr><td><?php echo $name;?></td><td><a href='mailto:<?php echo $email;?>'><?php echo $email;?></a></td><td><?php echo $comment;?></td><td><?php echo $ts;?><br><?php echo $ago;?></td><td><a href='delpost.php?id=<?php echo $id;?>' onclick="return confirm('Are you sure ?')">delete</a></td><tr>
<?php
}
?>
</table>
</body>
</html>
