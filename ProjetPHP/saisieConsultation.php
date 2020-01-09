<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Saisie de consultation</title>
	</head>
	<body>
		<fieldset>
		<legend>Saisie d'une nouvelle consultation</legend>
			<?php
				try {
					$linkpdo = new PDO("mysql:host=localhost;dbname=cabinet medical", "root", "");
					$linkpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				} catch (Exception $e) {
					die ("Erreur : ".$e->getMessage());
				}
				
				$req1 = $linkpdo->prepare("
					SELECT p.IdPatient, p.Nom, p.Prenom, p.DateNaissance, p.NumeroSecurite
					FROM Patient p
					ORDER BY p.Nom, p.Prenom
				");
				
				$req1->execute();
				
				while($data=$req1->fetch()) {
					echo $data['Nom'].' '.$data['Prenom'].' '.$data['DateNaissance'].' '.$data['NumeroSecurite']." <a href='saisieConsultationPatient.php?IdPatient=".$data['IdPatient']."'>Selectionner</a>".'</br>';
				}
				
				/*
				echo "<select name = 'sub1'>";
				while($data=$req1->fetch()) {
					echo "<option value='".$data['p.Nom']."'>".$data['p.Nom'].
					"</option>";
				}
				echo "</select>";
				*/
				
			?>
					
			<form action = "ajoutPatient.php" method = "post">
				<?php
					if(isset($_POST['nom'])) {
						$req = $linkpdo->prepare(
						"INSERT INTO Patient(Civilite, Nom, Prenom, Adresse, CodePostal, Ville, DateNaissance, LieuNaissance, NumeroSecurite)
						SELECT :civilite, :nom, :prenom, :adr, :cp, :ville, :dateN, :lieuN, :NumSecu
						FROM dual
						WHERE not exists (SELECT *
								FROM Patient p
								WHERE p.NumeroSecurite = :NumSecu)"
								);
					
						$req->execute(array('civilite'=>$_POST['civilite'], 'nom'=>$_POST['nom'], 'prenom'=>$_POST['prenom'], 'adr'=>$_POST['adr'], 'cp'=>$_POST['cp'], 'ville'=>$_POST['ville'], 'dateN'=>$_POST['dateN'], 'lieuN'=>$_POST['lieuN'], 'NumSecu'=>$_POST['NumSecu']));
					}
				?>
			</form>
		</fieldset>
	</body>
</html>
