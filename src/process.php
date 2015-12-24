<?php

function error($msg){
include("header.html");
echo "<h2 id=\"error\" align=\"center\" onclick=\"loadLogin()\"> $msg</h2>";
include("footer.html");
}
require_once("config.php");
$flag = 1;
if(isset($_POST['uid']) && isset($_POST['pwd']))     {
$uid= strtoupper($_POST['uid']);
$pwd= md5($_POST['pwd']);
$jam = mysqli_query($con, "SELECT * from user where uid = '$uid' AND psm = '$pwd'");
if(mysqli_num_rows($jam)>0)      {
setcookie("ses","$uid"."L"."$pwd");  //$\uidL$pwd is value of cookies and ses is name of cookies with no expiration date
mysqli_query($con, "UPDATE user SET cok='$uid"."L$pwd' WHERE uid='$uid'");
$flag = 0;
}   
else{
	error("Wrong ID / Password");
}
}

if( isset($_POST['names']) & isset($_POST['uids']) & isset($_POST['pwds']) )     {
$name = $_POST['names'];
$uids = strtoupper($_POST['uids']);
$pwds = $_POST['pwds'];
$psm = md5($pwds);
$jam = mysqli_query($con, "SELECT * from user where uid='$uids'");
echo "</br>".mysqli_num_rows($jam);
if(mysqli_num_rows($jam)<1)     {
$query = "INSERT INTO user (name, psm, uid, pass) VALUES ('$name', '$psm', '$uids', '$pwds')";
$jma=  mysqli_query($con, $query);
setcookie("ses","$uids"."L"."$psm");
mysqli_query($con, "UPDATE user SET cok='$uids"."L$psm' WHERE uid='$uids'");
$flag = 0;
}
else{
	error("USER $uids Already Exists");
}   }
mysqli_close($con);
if($flag ==0)
header("Location: ./index.php");

?>