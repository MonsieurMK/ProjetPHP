<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Modification patients</title>
	</head>
	<body>
		<fieldset>
		<legend>Modification du patient</legend>
			<?php
				try {
					$linkpdo = new PDO("mysql:host=localhost;dbname=cabinet medical", "root", "");
					$linkpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				} catch (Exception $e) {
					die ("Erreur : ".$e->getMessage());
				}
			
				
				if (isset($_GET['IdPatient'])) {
					$req = $linkpdo->prepare("SELECT Civilite, Nom, Prenom, Adresse, CodePostal, Ville
						FROM Patient
						WHERE IdPatient = :IdPatient");
						
					$req->execute(array('IdPatient'=> $_GET['IdPatient']));

					$data = $req->fetch();

					$reqMed = $linkpdo->prepare("
						SELECT IdMedecin, Nom, Prenom
						FROM Medecin
					");
					
					$reqMed->execute();

					?>
					<form action = "modificationPatient.php" method = "post">
						<p>Nom : <input type = "text" name = "nom" value="<?php echo $data['Nom'] ?>"/></p>
						<p>Prénom : <input type = "text" name = "prenom" value="<?php echo $data['Prenom'] ?>"/></p>
						<p>Adresse : <input type = "text" name = "adr" value="<?php echo $data['Adresse'] ?>"/></p>
						<p>Code postal : <input type = "text" name = "cp" value="<?php echo $data['CodePostal'] ?>"/></p>
						<p>Ville : <input type = "text" name = "ville" value="<?php echo $data['Ville'] ?>"/></p>
						<p><input type="hidden" name="IdPatient" value="<?php echo $_GET['IdPatient']; ?>" /></p>
						<?php
							echo "<p>Médecin référent: ";
							echo "<select name = 'sub1'>";
							while($dataMed=$reqMed->fetch()) {
								echo "<option value='".$dataMed['IdMedecin']."'>".$dataMed['Nom'].' '.$dataMed['Prenom']."</option>";
							}
							echo "</select>";
						?>
						<input type = "submit" value = "Valider" name="submit"/></p>
					</form>
					<?php
				}
			
				if (isset($_POST['submit'])) {
					$nom = $_POST["nom"];
					$prenom = $_POST["prenom"];
					$adr = $_POST["adr"];
					$cp = $_POST["cp"];
					$ville = $_POST["ville"];
					$idMedecin = $_POST["sub1"];
			
					$req = $linkpdo->prepare("UPDATE Patient 
					SET Nom=:nom, Prenom=:prenom, Adresse=:adr, CodePostal=:cp, Ville=:ville, IdMedecin=:idMedecin
					WHERE IdPatient = :IdPatient");

					$req->execute(array(
						'nom'=> $nom, 
						'prenom' => $prenom, 
						'adr'=> $adr, 
						'cp'=> $cp, 
						'ville'=> $ville, 
						'IdPatient'=> $_POST['IdPatient'],
						'idMedecin'=> $idMedecin
					));
				
					echo "Patient modifié</br>";
					echo  "<a href='affichagePatient.php'>Retour à la liste des patients</a>";
				}
			?>
		</fieldset>
	</body>
</html>
