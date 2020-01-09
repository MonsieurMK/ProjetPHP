<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Modification Medecin</title>
	</head>
	<body>
		<fieldset>
		<legend>Modification du Medecin</legend>
			<?php
				try {
					$linkpdo = new PDO("mysql:host=localhost;dbname=cabinet medical", "root", "");
					$linkpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				} catch (Exception $e) {
					die ("Erreur : ".$e->getMessage());
				}
			
				
				if (isset($_GET['IdMedecin'])) {
					$req = $linkpdo->prepare("SELECT Civilite, Nom, Prenom
						FROM Medecin
						WHERE IdMedecin = :IdMedecin");
						
					$req->execute(array('IdMedecin'=> $_GET['IdMedecin']));
					$data = $req->fetch();
					?>
					<form action = "modificationMedecin.php" method = "post">
						<p>Nom : <input type = "text" name = "nom" value="<?php echo $data['Nom'] ?>"/></p>
						<p>Prénom : <input type = "text" name = "prenom" value="<?php echo $data['Prenom'] ?>"/></p>
						<p><input type="hidden" name="IdMedecin" value="<?php echo $_GET['IdMedecin']; ?>" /></p>
						<input type = "submit" value = "Valider" name="submit"/></p>
					</form>
					<?php
				}
			
				if (isset($_POST['submit'])) {
					$nom = $_POST["nom"];
					$prenom = $_POST["prenom"];
			
					$req = $linkpdo->prepare("UPDATE Medecin 
					SET Nom=:nom, Prenom=:prenom
					WHERE IdMedecin = :IdMedecin");

					$req->execute(array(
						'nom'=> $nom, 
						'prenom' => $prenom, 
						'IdMedecin'=> $_POST['IdMedecin']
					));
				
					echo "Medecin modifié</br>";
					echo  "<a href='affichageMedecin.php'>Retour à la liste des Medecins</a>";
				}
			?>
		</fieldset>
	</body>
</html>
