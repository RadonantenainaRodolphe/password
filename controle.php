<?php 
session_start();
//Créer une session pour le nombre de tentative
if(!isset($_SESSION['limit']))
{
	$_SESSION['limit']= 2;
}
else
{
	$_SESSION['limit']=$_SESSION['limit']-1;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Beinvenu</title>
	<style type="text/css">
		body{
			margin: auto;
			width:50%;
			border:2px solid black;
			text-align: center;
			border-radius: 5px;

		}
	</style>
</head>
<body>
	
	<?php
		//La class
		class Visiteur
		{
			private $pseudo;
			private $pass;
			public function getPseudo()
			{
				return $this->pseudo;
			}
			public function setPseudo($pseudo)
			{
				$this->pseudo=$pseudo;
			}
			public function setPass($pass)
			{
				$this->pass=$pass;
			}
			public function getPass()
			{
				return $this->pass;
			}
		}

		//On instancie l'objet
		$membre = new Visiteur();
		
		//Connexion à la base de donnée
		try
		{
			$conn = new PDO('mysql:host=localhost;dbname=chat','root','');
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$sql = 'SELECT*FROM inscription';
			$select_base = $conn->query($sql);
			$value= $select_base->fetch();
		}
		catch(PDOException $e)
		{
			echo 'Connection failled'. $e->getMessage();
		}
		
		//include_once('controle.class.php');
		
		if(isset($_POST['nom']) && isset($_POST['pass']))
		{
			$nom = $_POST['nom'];
			$pass = $_POST['pass'];
		}
		//On recupère le pseudo et le mot de passe du Visiteur
		$membre->setPseudo($nom); 
		$membre->setPass($pass);

		//On teste si le Visiteur est bien dans la base de donnée
		if(($value['pseudo'] == $membre->getPseudo()) && ($value['pass'] ==  $membre->getPass()))
		{
			echo "<h1>Bienvenu</h1>";
			echo "<p>Bienvenu Mr/Mrs ".$membre->getPseudo(). "</p>";
			echo "<p>Votre code est : " .$membre->getPass() ."</p>";
		}
		else
		{
			
			if((isset($_SESSION['limit'])) && ($_SESSION['limit']>0))
			{
				echo "<p>Votre pseudo ou votre mot de passe n'est pas correcte </p>";
				echo "<p> Vous avez encore ".$_SESSION['limit']. " essai";
				include('motDePass.php');
			}
			else
			{
				echo "<p>Vous avez atteint le nombre max d'essai</p>";
				session_destroy();
			}
			
			
			
			
		}
		$conn->Null;
		
	?>
</body>
</html>
