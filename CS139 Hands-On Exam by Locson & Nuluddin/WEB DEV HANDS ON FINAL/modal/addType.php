<?php
	session_start();
	include_once('../database/database.php');

	if(isset($_POST['addType'])){
		$database = new Connection();
		$db = $database->open();
		try{
			//make use of prepared statement to prevent sql injection
			$sql = $db->prepare("INSERT INTO type (name) VALUES (:name)");

			//bind
			$sql->bindParam(':name', $_POST['name']);
			
			//if-else statement in executing our prepared statement
			$_SESSION['message'] = ( $sql->execute()) ? 'Type of Animal added successfully' : 'Something went wrong. Cannot add Type of Animal.';	
	    
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$database->close();
	}

	else{
		$_SESSION['message'] = 'Fill up add form first';
	}

	header('location: ../index.php');
	
?>