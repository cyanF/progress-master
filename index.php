<?php
	include("common.php");
	top();
?>
		<div id="main">
			<p>
				Log in now to check your progress bar.<br />
				Contact Fasi if you don't have an account.
			</p>

			<form id="loginform" action="login.php" method="post">
				<div><input name="name" type="text" size="8" autofocus="autofocus" /> <strong>User Name</strong></div>
				<div><input name="password" type="password" size="8" /> <strong>Password</strong></div>
				<div><input type="submit" value="Log in" /></div>
			</form>
		</div>

<?php
	bottom();
?>