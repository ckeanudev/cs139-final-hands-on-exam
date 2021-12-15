<?php
	session_start();
	include_once('../database/database.php');

	if(isset($_POST['deleteAnimal'])){
		$database = new Connection();
		$db = $database->open();
		try{

			//make use of prepared statement to prevent sql injection
			$sql = $db->prepare("DELETE FROM animals WHERE id = :animalsid");

            //bind params
            $sql->bindParam(':animalsid', $_GET['id'], PDO::PARAM_INT);

			//if-else statement in executing our prepared statement
			$_SESSION['message'] = ( $sql->execute()) ? 'Animal deleted successfully': 'Something went wrong. Cannot delete Animal.';	
	    
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