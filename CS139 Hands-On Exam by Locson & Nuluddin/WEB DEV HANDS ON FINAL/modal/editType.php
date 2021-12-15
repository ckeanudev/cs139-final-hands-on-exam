<?php
	session_start();
	include_once('../database/database.php');

	if(isset($_POST['editType'])){
		$database = new Connection();
		$db = $database->open();
		try{
			//make use of prepared statement to prevent sql injection
			$sql = $db->prepare("UPDATE type SET name = :name WHERE id = :typeid ");

			//bind
			$sql->bindParam(':name', $_POST['name']);
			$sql->bindParam(':typeid', $_GET['id'], PDO::PARAM_INT);


			//if-else statement in executing our prepared statement
			$_SESSION['message'] = ( $sql->execute()) ? 'Type of Animal edited successfully' : 'Something went wrong. Cannot edit Type of Animal.';	
	    
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$database->close();
	}

	else{
		$_SESSION['message'] = 'Fill up edit form first';
	}

	header('location: ../index.php');
	
?>