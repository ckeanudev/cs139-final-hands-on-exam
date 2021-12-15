<?php
	session_start();
	include_once('../database/database.php');

	if(isset($_POST['editAnimal'])){
		$database = new Connection();
		$db = $database->open();
		try{
			//make use of prepared statement to prevent sql injection
			$sql = $db->prepare("UPDATE animals SET name = :name, type_id = :type_id, color = :color, number_of_legs = :number_of_legs, remarks = :remarks  WHERE id = :animalsid ");

			//bind
			$sql->bindParam(':name', $_POST['name']);
            $sql->bindParam(':type_id', $_POST['type_id']);
			$sql->bindParam(':color', $_POST['color']);
			$sql->bindParam(':number_of_legs', $_POST['number_of_legs']);
			$sql->bindParam(':remarks', $_POST['remarks']);
			$sql->bindParam(':animalsid', $_GET['id'], PDO::PARAM_INT);


			//if-else statement in executing our prepared statement
			$_SESSION['message'] = ( $sql->execute()) ? 'Animal edited successfully' : 'Something went wrong. Cannot edit Animal.';	
	    
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