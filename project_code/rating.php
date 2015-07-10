<?php

function drawProd($isbn, $rate){
global $con;
	$res=mysqli_query($con, "SELECT name, author from book WHERE isbn='$isbn'");
	$row=mysqli_fetch_array($res, MYSQLI_NUM);
	$name=$row[0];
	$author=$row[1];
	echo "
<div class=\"col-sm-4\">
<div class=\"imageHolder\"> 
<img   src=\"image/$isbn.jpg\"/>
</div>
<div class=\"caption post-content\">
<h3 align='center'>$name</h3>
 <p><b>Written by: </b>$author</p> 
 <p><b>Rating: </b>$rate</p>
<p></br></p> 
</div>
</div>";
	
}
if(isset($_COOKIE['ses'])){
	include("config.php");
	$query= "SELECT id FROM user where cok='".$_COOKIE['ses']."'";
	$result= mysqli_query($con, $query);
	if(mysqli_num_rows($result)>0){
	$row=mysqli_fetch_array($result);
	$uid=$row['id'];
	$query= "SELECT bid, rating FROM rating WHERE uid=$uid";
    $resu= mysqli_query($con, $query);
	if(mysqli_num_rows($resu)>0){
	while($row=mysqli_fetch_array($resu))
	drawProd($row['bid'], $row['rating']);
	}
    mysqli_close($con);
	
	}}


?>