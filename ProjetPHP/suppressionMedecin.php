<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Suppression du Medecin</title>
	</head>
	<body>
		<fieldset>
		<legend>Suppression du Medecin</legend>
			<?php
				try {
					$linkpdo = new PDO("mysql:host=localhost;dbname=cabinet medical", "root", "");
					$linkpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				} catch (Exception $e) {
					die ("Erreur : ".$e->getMessage());
				}
			
				
				if (isset($_GET['IdMedecin'])) {
					?>
					<h2>Souhaitez-vous supprimer le Medecin ?</h2>
					<form action = "suppressionMedecin.php" method = "post">
						<p><input type="hidden" name="IdMedecin" value="<?php echo $_GET['IdMedecin']; ?>" /></p>
						<p><input type = "submit" value = "Oui" name = "oui"/>
					</form>
					<form action = "affichageMedecin.php" method = "post">
						<input type = "submit" value = "Annuler" name = "non"/></p>
					</form>
					<?php
				}
				
				if (isset($_POST['oui'])) {
					$req=$linkpdo->prepare("
						DELETE FROM Medecin
						WHERE IdMedecin = :IdMedecin
					");
					
					$req->execute(array('IdMedecin'=>$_POST['IdMedecin']));
					
					echo "Medecin supprimé</br>";
					echo  "<a href='affichageMedecin.php'>Retour à la liste des Medecins</a>";
				}
			?>
		</fieldset>
	</body>
</html>
