<?php
	
	session_start();
	//et saab kasutada $_SESSION muutujaid
	//k�igis failies mis on selle failiga seotud
	$database = "if16_brigitta";
	//var_dump(%GLOBALS);
	
	function signup($email, $password) {
			
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES(?,?)");
		
		echo $mysqli->error;
		
		$stmt->bind_param("ss", $email, $password);
		
		if ($stmt->execute() ) {
			
			echo "saving success";
		} else {
			
			echo "ERROR ".$stmt->error;
		}
		
		
	}
	
	function login($email, $password) {
		
		$notice = "";
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id, email, password, created FROM user_sample WHERE email=? ");
		
		$stmt->bind_param("s", $email);
		//m��ran muutujad reale mille k�tte saan
		
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
		
		$stmt->execute();
		
		//ainult SELECT'i puhul 
		if ($stmt->fetch()) {
			
			//v�hemalt 1 rida andmeid tuli l�bi
			
			$hash = hash("sha512", $password);
			if ($hash == $passwordFromDb) {
				//�nnestus
				echo "user ".$id." logged in";
				
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				
				header("Location: data.php");
				
			} else {
				$notce = "wrong password";
			}
				
			
			
		} else {
			//ei leitud �hetgi rida
			$notice = "there's no email like that!";
			
		}
		return $notice;
	}
		
		

	
	
	/*function hello($firstname, $lastname) {
		
		return "welcome ".$firstname." ".$lastname."!";
	}
	echo hello("Brigitta", "Kannel")
	
	*/
?>