<div class="col-sm-4 col-sm-offset-1">					
		<div class="login-form"><!--login form-->
		<h2>Login to your account</h2>
		<form action="process.php" method="post">
			<input type="text" placeholder="User ID*" name="uid" required  />
			<input type="password" placeholder="Password*"  name="pwd" required />
			<button type="submit" class="btn btn-blue">Login</button>
		</form>
		</div><!--/login form-->
 	</div>
<div class="col-sm-1">
 <h2 class="or">OR</h2>
</div>
<div class="col-sm-4">
 <div class="signup-form"><!--sign up form-->
	<h2>New User Signup!</h2>						
	<form name="signup" action="process.php" onsubmit="return validate()" method="post" >
		<input type="text" placeholder="Name*" name="names" required />
		<input type="text" placeholder="User ID*" name="uids" required />
		<input type="password" placeholder="Password*" name="pwds" required />
		<input type="password" placeholder="Confirm Password*" name="cpwd" required />
		<button type="submit" class="btn btn-blue"  >Sign up</button>
	</form>
</div><!--/sign up form-->
</div>