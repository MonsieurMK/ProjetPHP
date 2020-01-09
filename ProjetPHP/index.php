<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Cabinet médical</title>
	</head>
	<body>
		<?php
			if (!isset($_SESSION['identifiant'])) {
				echo 'pas de session';
			} else {
				echo 'oui session';
			}
		?>
		<fieldset>
		<legend>Cabinet médical</legend>
			<h1>Bienvenue au cabinet médical</h1>
			<button onclick="window.location.href = 'affichagePatient.php';">Patients</button>
			<button onclick="window.location.href = 'affichageMedecin.php';">Médecins</button>
			<button onclick="window.location.href = 'affichageConsultation.php';">Consultations</button>
			<button onclick="window.location.href = 'statistiques.php';">Statistiques</button>
		</fieldset>
	</body>
</html>
