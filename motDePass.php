<!DOCTYPE html>
<html>
<head>
	<title>PAGE D'ACCES</title>
	<meta charset="utf-8">
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
	<h1>Page d'accés</h1>
	<form action="controle.php" method="POST">
		<p><label>Pseudo :<input type="text" name="nom"></label></p>
		<p><label>Mot de Passe :<input type="password" name="pass"></label></p>
		<p><input type="submit" name="envoyer" value="OK"></p>
	</form>
</body>
</html>

