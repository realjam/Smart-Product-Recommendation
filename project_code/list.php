<?php
$cou=1;
function drawProduct($isbn,$name, $author, $price){
global $cou;
	echo "
<div class=\"col-sm-4\">
<div class=\"imageHolder\"> 
<img   src=\"image/$isbn.jpg\" />
<div class=\"caption\"> 
<h4>Give your Rating </h4>
<form name='f$cou' id='f$cou 'action=\"rate.php\" method='GET'>
<input type='hidden' name='isbn' value='$isbn' />
<input type=\"number\" name=\"rate\" autocomplete='off' min=0 max=5 required />
<input id=\"submit\" type=\"submit\" value=\"Submit\">
</form>
</div></div>
<div class=\"caption post-content\">
<h3>$name</h3>
 <p><b>Written by: </b>$author</p> 
 <p><b>Price: </b>&#8377;$price</p> 
 <p></br></p>
</div>
</div>";
	$cou++;
}
	include("config.php");
	$lmt="";
	if(isset($_GET['grp'])){
		$lnum=$_GET['grp']*10;
		$lmt="LIMIT $lnum";
		
	}
	$command= "SELECT isbn, name, author, price FROM book";
	$filter= array();
	if(isset($_COOKIE['ses'])){
	$cok= $_COOKIE['ses'];
	$uidr= mysqli_query($con, "SELECT id FROM user WHERE cok= '$cok'");
	$row_uid= mysqli_fetch_array($uidr);
	$uid=$row_uid['id'];
	$command_filter= "SELECT distinct bid FROM rating WHERE uid= $uid";
	$j=0;
	$filter= array();
	$result_filter = mysqli_query($con, $command_filter);
	while($row_filter = mysqli_fetch_array($result_filter, MYSQLI_NUM)){
		$filter[$j]= $row_filter[0];
		$j++;
		}}
	$result = mysqli_query($con, $command);
		while($row=mysqli_fetch_array($result,MYSQLI_NUM)){
		$flag=0;
		for ($i=0;$i<count($filter); $i++){
		if($filter[$i] == $row[0]){
		$flag=1;
		break;
		}}
		if($flag==0)
		drawProduct($row[0], $row[1], $row[2], $row[3]);

		}
	mysqli_close($con);
?>
