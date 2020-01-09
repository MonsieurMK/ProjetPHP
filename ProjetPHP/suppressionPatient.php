<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Suppression du patient</title>
	</head>
	<body>
		<fieldset>
		<legend>Suppression du patient</legend>
			<?php
				try {
					$linkpdo = new PDO("mysql:host=localhost;dbname=cabinet medical", "root", "");
					$linkpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				} catch (Exception $e) {
					die ("Erreur : ".$e->getMessage());
				}
			
				
				if (isset($_GET['IdPatient'])) {
					?>
					<h2>Souhaitez-vous supprimer le patient ?</h2>
					<form action = "suppressionPatient.php" method = "post">
						<p><input type="hidden" name="IdPatient" value="<?php echo $_GET['IdPatient']; ?>" /></p>
						<p><input type = "submit" value = "Oui" name = "oui"/>
					</form>
					<form action = "affichagePatient.php" method = "post">
						<input type = "submit" value = "Annuler" name = "non"/></p>
					</form>
					<?php
				}
				
				if (isset($_POST['oui'])) {
					$req=$linkpdo->prepare("
						DELETE FROM Patient
						WHERE IdPatient = :IdPatient
					");
					
					$req->execute(array('IdPatient'=>$_POST['IdPatient']));
					
					echo "Patient supprimé</br>";
					echo  "<a href='affichagePatient.php'>Retour à la liste des patients</a>";
				}
			?>
		</fieldset>
	</body>
</html>
