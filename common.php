<?php

function top(){?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Doubi Chuunibyou Studio</title>
		<script src="countDown.js" type="text/javascript"></script> 
		<link href="style.css" type="text/css" rel="stylesheet" />
		<link href="favicon.ico" type="image/ico" rel="shortcut icon" />
	</head>

	<body>
		<div class="headfoot">
			<h1>
				<a href="index.php"><img src="logo.jpg" alt="logo" /></a>
				Doubi<br />Chuunibyou Studio
			</h1>
		</div>	
<?php }

function bottom() { ?>
		<div class="headfoot">
			<p>
				All pages and content &copy; Copyright Doubi Chuunibyou Stuidio.
			</p>

			<div id="w3c">
				<a href="https://webster.cs.washington.edu/validate-html.php">
					<img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML" /></a>
				<a href="https://webster.cs.washington.edu/validate-css.php">
					<img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
			</div>
		</div>
	</body>
</html>
	
<?php }
?>