<?php
	//et saada ligi sessioonile)
	require("functions.php");
	
	if(!isset ($_SESSION["userId"])) {
		header("Location: login.php");
	}
	

//kas kasutaja tahab välja logida
//kas aadrrssireal on logout olemas
	if(isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: login.php");
		
	}



?>

<h1>DATA</h1>
<p>Welcome <?=$_SESSION["userEmail"];?>!
<br><br>
<a href="?logout=1">Log Out</a>
</p>