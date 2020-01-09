<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Patients</title>
	</head>
	<body>
		<fieldset>
			<legend>Affichage des patients</legend>
		<?php
			try {
				$linkpdo = new PDO("mysql:host=localhost;dbname=cabinet medical", "root", "");
			} catch (Exception $e) {
				die ("Erreur : ".$e->getMessage());
			}
			
			$req=$linkpdo->prepare("
				SELECT p.IdPatient, p.Nom, p.Prenom, p.DateNaissance, p.NumeroSecurite, m.Nom, M.Prenom
				FROM Patient p, Medecin m
				WHERE m.IdMedecin = p.IdMedecin
				ORDER BY p.Nom, p.Prenom
			");
			
			$req->execute();
			
			while($data=$req->fetch()) {
				echo  $data[1].' '.$data[2].' '.$data[3].' '
				.$data[4]." Médecin : ".$data[5]." ".$data[6].
				" "."<a href='modificationPatient.php?IdPatient=".$data['IdPatient']."'>Modifier</a>"." "."<a href='suppressionPatient.php?IdPatient=".$data['IdPatient']."'>Supprimer</a></br>";
			}
			?>
				<button onclick="window.location.href = 'ajoutPatient.php';">Ajouter un patient</button>
			<?php			
			$req->closeCursor();
		?>
		<p><a href='index.php'>Retour au menu principal</a>
		</fieldset>
	</body>
</html>
