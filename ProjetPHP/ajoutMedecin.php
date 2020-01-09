<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Ajout Medecins</title>
	</head>
	<body>
		<fieldset>
		<legend>Ajout de nouveau Medecins</legend>
			<form action = "ajoutMedecin.php" method = "post">
				<input type="radio" name="civilite" value="male" checked> M
  				<input type="radio" name="civilite" value="female"> Mme
				<p>Nom : <input type = "text" name = "nom" required /></p>
				<p>Prénom : <input type = "text" name = "prenom" required /></p>
				<p><input type = "reset" value = "Vider"/>
				<input type = "submit" value = "Valider"/></p>
				
				<?php
					try {
						$linkpdo = new PDO("mysql:host=localhost;dbname=cabinet medical", "root", "");
						$linkpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					} catch (Exception $e) {
						die ("Erreur : ".$e->getMessage());
					}
					if(isset($_POST['nom'])) {
						$req = $linkpdo->prepare(
						"INSERT INTO Medecin(Civilite, Nom, Prenom)
						VALUES (:civilite, :nom, :prenom)");
					
						$req->execute(array('civilite'=>$_POST['civilite'], 'nom'=>$_POST['nom'], 'prenom'=>$_POST['prenom']));
					}
				?>
			</form>
			<p><a href='affichageMedecin.php'>Retour à la liste des médecins</a>
		</fieldset>
	</body>
</html>
