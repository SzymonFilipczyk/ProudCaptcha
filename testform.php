<?php
session_start();
if (isset($_GET['getCaptchaPassword'])) {
	echo $_SESSION['captcha']." in ".$_SESSION['captcha_generation_time']."s";
	die();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Preview ProudCaptcha</title>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<style type="text/css">
body,td,th {
	font-family: Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif;
	font-style: normal;
	font-weight: 400;
	font-size: 16px;
	color: rgba(255,255,255,1);
	text-align:center;
}
body {
	background-color: rgba(51,51,51,1);
}
a {
	color:rgba(255,255,255,1);	
}
.captcha_id {
	font-size:24px;
}
</style>
</head>

<body>
<header>
	<h1>ProudCaptcha</h1>
</header>
<article>
	<img src="captcha.php">
	<p>Your password is: <span class="captcha_id">wait</span></p>
	<p><button onClick="location.reload();">Get new captcha</button></p>
</article>
<footer>
	&copy; 2014 - <a href="http://filipczyk.net/">Szymon Filipczyk</a>
</footer>
<script>
	setTimeout(function(){
		$(".captcha_id").load("testform.php?getCaptchaPassword");
	}, 500);
</script>
</body>
</html>