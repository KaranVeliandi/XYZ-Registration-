<?php

	session_start();
	$_SESSION = array();
	session_destroy ();


header('Location:login.html');

exit;



?>

<html>
<head></head>
<title></title>
<body>
<style><?php  include 'NewStyle.css';?></style>
</body>
</html>