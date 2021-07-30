<?php
	$serverName = "localhost";
	$userName = "root";
	$password = "";
	try
	{
		$conn = new PDO("mysql:host=$serverName;dbname=test",$userName,$password);
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);	
		$sql = 'SELECT * FROM Visiteur';
		$reponse = $conn->query($sql);
		while($donnee = $reponse->fetch())
		{
			echo '<p>' . $donnee['pseudo'] . '</p>';
		}
	}
	catch(PDOException $e)
	{
		echo "connection failled : " . $e->getMessage();
	}

	$conn->null;
	
?>