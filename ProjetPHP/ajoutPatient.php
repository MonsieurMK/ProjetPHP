<?php
	try {
		$linkpdo = new PDO("mysql:host=localhost;dbname=cabinet medical", "root", "");
		$linkpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		die ("Erreur : ".$e->getMessage());
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Ajout patients</title>
	</head>
	<body>
		<fieldset>
		<legend>Ajout de nouveau patients</legend>
			<form action = "ajoutPatient.php" method = "post">
				<input type="radio" name="civilite" value="male" checked> M
  				<input type="radio" name="civilite" value="female"> Mme
				<p>Nom : <input type = "text" name = "nom" required /></p>
				<p>Prénom : <input type = "text" name = "prenom" required /></p>
				<p>Adresse : <input type = "text" name = "adr"/ required ></p>
				<p>Code postal : <input type = "text" name = "cp" required /></p>
				<p>Ville : <input type = "text" name = "ville" required /></p>
				<p>Date de naissance : <input type = "date" name = "dateN" required /></p>
				<p>Lieu de naissance : <input type = "text" name = "lieuN" required /></p>
				<p>Numéro de sécurité sociale : <input type = "number" name = "NumSecu" required /></p>
				<?php
					$reqMed = $linkpdo->prepare("
						SELECT IdMedecin, Nom, Prenom
						FROM Medecin
					");
					
					$reqMed->execute();
					
					echo "<p>Médecin référent: ";
					echo "<select name = 'sub1'>";
					while($data=$reqMed->fetch()) {
						echo "<option value='".$data['IdMedecin']."'>".$data['Nom'].' '.$data['Prenom']."</option>";
					}
					echo "</select>";
				?>
				<p><input type = "reset" value = "Vider"/>
				<input type = "submit" value = "Valider"/></p>
				
				<?php
					if(isset($_POST['nom'])) {
						$req = $linkpdo->prepare(
						"INSERT INTO Patient(Civilite, Nom, Prenom, Adresse, CodePostal, Ville, DateNaissance, LieuNaissance, NumeroSecurite, IdMedecin)
						SELECT :civilite, :nom, :prenom, :adr, :cp, :ville, :dateN, :lieuN, :NumSecu, :IdMedecin
						FROM dual
						WHERE not exists (SELECT *
								FROM Patient p
								WHERE p.NumeroSecurite = :NumSecu)"
						);
					
						$req->execute(array(
							'civilite'=>$_POST['civilite'],
							'nom'=>$_POST['nom'], 
							'prenom'=>$_POST['prenom'], 
							'adr'=>$_POST['adr'], 
							'cp'=>$_POST['cp'], 
							'ville'=>$_POST['ville'], 
							'dateN'=>$_POST['dateN'], 
							'lieuN'=>$_POST['lieuN'], 
							'NumSecu'=>$_POST['NumSecu'], 
							'IdMedecin'=>$_POST['sub1']
						));
					}
				?>
			</form>
			<p><a href='affichagePatient.php'>Retour à la liste des patients</a>
		</fieldset>
	</body>
</html>
