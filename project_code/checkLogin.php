<?php
if(isset($_COOKIE['ses'])){
	include("config.php");
	$query= "SELECT name FROM user where cok='".$_COOKIE['ses']."'";
	$result= mysqli_query($con, $query);
	if(mysqli_num_rows($result)>0){
	$row=mysqli_fetch_array($result);
	$uid=$row['name'];
	echo "<li>
<div class=\"dropdown\">
        <button class=\"btn btn-default dropdown-toggle\" type=\"button\" id=\"menu1\" data-toggle=\"dropdown\">Welcome $uid
        <span class=\"caret\"></span></button>
        <ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"menu1\" align=\"right\">
          <li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"#\" onclick=\"rating()\">My Rating</a></li>
          <li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"#\" onclick=\"changePass()\">Change Password</a></li>
          <li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"#\" onclick=\"signout()\">Sign out</a></li>
        </ul>
      </div>	
	</li>"; 
	}
	else {
		unset($_COOKIE['ses']);
		echo "<li><a href=\"#\" onclick=\"loadLogin()\">Sign in / Sign up</a></li>";
	}
	
	
	
}
else {
		echo "<li><a href=\"#\" onclick=\"loadLogin()\">Sign in / Sign up</a></li>";
	}    

?>