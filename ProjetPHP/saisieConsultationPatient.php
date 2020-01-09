<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Saisie Consultation</title>
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
			
				
				if (isset($_GET['IdPatient'])) {
					$IdPatient = $_GET['IdPatient'];
					
					echo "<form action = 'saisieConsultationPatient.php' method = 'post'>";
					echo "Médecin : ";
					echo "<select name = 'sub1'>";
	
						$reqRef = $linkpdo->prepare("
							SELECT m.IdMedecin, m.Nom, m.Prenom
							FROM Medecin m, Patient p
							WHERE m.IdMedecin = p.IdMedecin
							AND p.IdPatient = :idPatient
						");

						$reqRef->execute(array('idPatient'=>$_GET['IdPatient']));

						while($dataRef=$reqRef->fetch()){
							echo "<option value='".$dataRef['IdMedecin']."'>".$dataRef['Nom'].' '.$dataRef['Prenom']."</option>";
							$idMedecinRef = $dataRef['IdMedecin'];
						}
						
						$req = $linkpdo->prepare("
							SELECT IdMedecin, Nom, Prenom
							FROM Medecin
							WHERE IdMedecin <> :idMedecin
						");
						
						$req->execute(array('idMedecin'=>$idMedecinRef));

						while($data=$req->fetch()) {
							echo "<option value='".$data['IdMedecin']."'>".$data['Nom'].' '.$data['Prenom']."</option>";
						}
					echo "</select>";
					echo " Date : "."<input type='date' name='date'>";
					echo " Heure : "."<input type='time' name='time'>";
					echo " Durée : "."<input type='time' name='duree' value='00:30'>";
					echo " <input type = 'submit' value = 'Valider' name='submit'/>";
					echo "<input type='hidden' name='IdPatient' value='".$_GET['IdPatient']."' />";
					echo "</form>";
					
				}
			
				if (isset($_POST['submit'])) {
					$idMedecin = $_POST['sub1'];
					$idPatient = $_POST['IdPatient'];
					$date = $_POST['date'];
					$heure = $_POST['time'];
					$duree = $_POST['duree'];
					
					$req = $linkpdo->prepare("
						INSERT INTO Rendez_vous (IdMedecin, IdPatient, DateRDV, Heure, Duree)
						VALUES (:IdMedecin, :IdPatient, :DateRDV, :Heure, :Duree)
					");
					
					$req->execute(array(
						'IdMedecin' => $idMedecin,
						'IdPatient' => $idPatient,
						'DateRDV' => $date,
						'Heure' => $heure,
						'Duree' => $duree
					));
				
					echo "Rendez-vous enregistré</br>";
					echo  "<a href='affichageConsultation.php'>Retour à la liste des consultations</a>";
				}
			?>
		</fieldset>
	</body>
</html>
