<?php
$name = $_POST["name"];
$password = $_POST["password"];

$userdata=file("users.sj",FILE_IGNORE_NEW_LINES);
foreach ($userdata as $user) {
	list($userName, $userPass) = explode(":",$user);
	if ($userName == $name) {
		#echo("it's ".$userName."!\n");
		if ($userPass == $password) {
			#echo("password fit!\n");
			session_start();
			$_SESSION["name"]=$name;
			
			header("Location: progress.php");
			die();
		} else {
			echo("password incorrect!\n");
			#header("Location: index.php");
			
		}
	} else {
		#echo("it's not ".$userName."!\n");
		
	}
}
#header("Location: index.php");
?>