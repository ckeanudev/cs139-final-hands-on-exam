<?php
	session_start();
	include_once('../database/database.php');

	if(isset($_POST['deleteType'])){
		$database = new Connection();
		$db = $database->open();
		try{

			//make use of prepared statement to prevent sql injection
			$sql = $db->prepare("DELETE FROM type WHERE id = :typeid");

            //bind params
            $sql->bindParam(':typeid', $_GET['id'], PDO::PARAM_INT);

			//if-else statement in executing our prepared statement
			$_SESSION['message'] = ( $sql->execute()) ? 'Type of Animal deleted successfully': 'Something went wrong. Cannot delete Type of Animal.';	
	    
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