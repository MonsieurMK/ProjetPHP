<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Consultations</title>
	</head>
	<body>
		<fieldset>
			<legend>Affichage des consultations</legend>
		<?php
			try {
				$linkpdo = new PDO("mysql:host=localhost;dbname=cabinet medical", "root", "");
				$linkpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (Exception $e) {
				die ("Erreur : ".$e->getMessage());
			}
			
			$req=$linkpdo->prepare("
				SELECT P.Nom, P.Prenom, P.NumeroSecurite, M.Nom, M.Prenom, R.DateRDV, R.Heure, R.Duree
				FROM Patient P, Medecin M, Rendez_vous R
				WHERE R.IdPatient = P.IdPatient
				AND R.IdMedecin = M.IdMedecin
				ORDER BY R.Heure, R.DateRDV DESC;
			");
			
			$req->execute();
		?>
			
			<table border ="25" cellpadding="5" align="center">
				<tr>
					<th>Nom Patient</th>
					<th>Prenom Patient</th>
					<th>Num Securite</th>
					<th>Nom Medecin</th>
					<th>Prenom Medecin</th>
					<th>Date RDV</th>
					<th>Heure</th>
					<th>Duree</th>
				</tr>
			
		<?php
			foreach($req as $data) {
				echo "<tr>";
					for ($i = 0 ; $i < 8 ; $i++) {
						echo "<td>".$data[$i]."</td>";
					}
				echo "</tr>";
			}
			/*
			while($data=$req->fetch()) {
				echo "Patient : ".$data[0].' '.$data[1].' '.$data[2]." => Médecin : ".$data[3].' '.$data[4].
				" Date : ".$data[5].' '.$data[6].' Duree : '.$data[7].'</br>';
			}
			*/
		?>
			</table>
				<button onclick="window.location.href = 'saisieConsultation.php';">Ajouter une Consultation</button>
		<?php			
			$req->closeCursor();
		?>
		<p><a href='index.php'>Retour au menu principal</a>
		</fieldset>
	</body>
</html>
