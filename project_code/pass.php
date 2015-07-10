<div class="col-sm-6 col-sm-offset-1">					
		<div class="login-form"><!--login form-->
		<h2>Change Password</h2>
		<form name="signup" action="" onsubmit="return validate()" method="post">
			<input type="password" placeholder="Current Password*" name="opwd" required  />
			<input type="password" placeholder="New Password*"  name="pwds" required />
			<input type="password" placeholder="Confirm Password*"  name="cpwd" required />
						<!--<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span> -->
			<button type="submit" class="btn btn-blue">Change Password</button>
		</form>
		</div><!--/login form-->
 	</div>

<?php
if(isset($_POST['opwd']) && isset($_COOKIE['ses'])){
$psm=md5($_POST['opwd']);
$pass=$_POST['opwd'];
$cok=$_COOKIE['ses'];
$npass=$_POST['pwds'];
$npsm=md5($_POST['pwds']);
include("config.php");
$res=mysqli_query($con,"SELECT uid FROM user where cok='$cok' AND psm='$psm'");
if(mysqli_num_rows($res)>0) {
$row=mysqli_fetch_array($res,MYSQLI_NUM);
$uid=$row[0];
$query="UPDATE user SET psm='$npsm', pass='$pass' WHERE uid='$uid' ";
mysqli_query($con, $query) or die();

echo "ok$uid dssd";

}
mysqli_close($con);



}

?>