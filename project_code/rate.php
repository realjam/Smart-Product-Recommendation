<?php

if(isset($_COOKIE['ses'])){
	$rate=$_GET['rate'];
	$isbn=$_GET['isbn'];
	$ses= $_COOKIE['ses'];
	include("config.php");
	$res=mysqli_query($con, "SELECT id from user where cok='$ses'");
	$row=mysqli_fetch_array($res, MYSQLI_NUM);
	$uid=$row[0];
	$resu=mysqli_query($con, "SELECT uid, bid FROM rating WHERE uid=$uid AND bid=$isbn");
	if(mysqli_fetch_row($resu)>0){
	echo "<script> alert('You Already rated this product');</script>";
	header('Location: index.php');
	exit(1);
	}
	else {
	$query="INSERT INTO rating(uid, bid, rating) VALUES($uid, $isbn, '$rate')";
	mysqli_query($con, $query);
	mysqli_close($con);	
	echo "<script> alert('You rating has been recorded for product: $isbn');</script>";
	header('Location: index.php');
	}
}

?>