<?php
include_once("config.php");
function drawProd($isbn){
global $con;
	$res=mysqli_query($con, "SELECT name, author from book WHERE isbn='$isbn'");
	if(mysqli_num_rows($res)==1){
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
</div>
</div>";
}	
}
if(isset($_COOKIE['ses'])){
	$book= array(array());
$cok=$_COOKIE['ses'];
$res=mysqli_query($con, "SELECT id from user WHERE cok='$cok'");
$row=mysqli_fetch_array($res, MYSQLI_NUM);
$uid=$row[0];
$result=mysqli_query($con, "SELECT COUNT(bid) from rating WHERE uid='$uid'");
$rows=mysqli_fetch_array($result, MYSQLI_NUM);
//var_dump($rows);
if($rows[0]>0){
	$resu=mysqli_query($con, "SELECT uid, bid, rating FROM rating ORDER BY uid");
	while ($row= mysqli_fetch_array($resu, MYSQLI_NUM)) {
	$uid=$row[0];
	$bid=$row[1];
	$rating=$row[2];
	
		$book[$uid][$bid]= $rating;
	}
	include_once("recommend.php");	
$re = new Recommend();
$as = array();
$as=$re->getRecommendations($book, $uid);
foreach ($as as $key=>$value)
drawProd($key);

}
$lo=rand(0,8);
$hi=$lo+1;
$resul=mysqli_query($con, "SELECT isbn from book LIMIT $lo, $hi");
$row= mysqli_fetch_array($resul, MYSQLI_NUM);
drawProd($row[0]);
mysqli_close($con);
exit(0);
}
?>