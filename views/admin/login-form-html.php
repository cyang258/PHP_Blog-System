<?php
if(isset($loginErrorMessage) === false){
	$loginErrorMessage = "";
}
return "
<form method='post' action='admin.php'>
	<p>Login to access restricted area</p>
	<label>e-mail</label>
	<input type='email' name='email' required />
	<p id='email-warning'></p>
	<label>password</label>
	<input type='password' name='password' required />
	<p id='password-warning'></p>
	<input type='submit' value='login' name='log-in' />
	<p>$loginErrorMessage</p>
</form>
";