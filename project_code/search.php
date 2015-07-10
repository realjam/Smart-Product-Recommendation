<?php
function drawProd($isbn, $name, $author){
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



if(isset($_GET['q'])){
$se=$_GET['q'];
$sear=strtolower(str_replace(" ","%",$se));
$search="%".$sear."%";
include("config.php");
$result=mysqli_query($con, "SELECT isbn, name, author FROM book WHERE name LIKE '$search' ");
$num=mysqli_num_rows($result);
echo "<h4 align=\"left\">Search results for: <b> $se</b> [ $num result]</h4></br>";
while($row=mysqli_fetch_array($result))
drawProd($row['isbn'], $row['name'], $row['author']);


mysqli_close($con);


}


?>