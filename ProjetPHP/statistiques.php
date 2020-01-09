<?php
				try {
					$linkpdo = new PDO("mysql:host=localhost;dbname=cabinet medical", "root", "");
					$linkpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				} catch (Exception $e) {
					die ("Erreur : ".$e->getMessage());
				}
			
				$req = $linkpdo->prepare(
						"select DateNaissance
						FROM Patient
						WHERE Civilite = 'male'"
								);
				$req->execute();
				$nbHommesMoins =0;
				$nbHommesEntre = 0;
				$nbHommesPlus = 0;
				
				while($data=$req->fetch()) {
					$from = new DateTime($data['DateNaissance']);
					$to   = new DateTime('today');
					$age = $from->diff($to)->y."</br>";
					if($age < 25){
						$nbHommesMoins ++;
					}else if($age > 50){
						$nbHommesPlus ++;						
					}else{
						$nbHommesEntre ++;
					}
				}
				
				//femmes
				$req = $linkpdo->prepare(
						"select DateNaissance
						FROM Patient
						WHERE Civilite = 'female' or  Civilite = 'other'"
								);
				$req->execute();
				$nbFemmesMoins =0;
				$nbFemmesEntre = 0;
				$nbFemmesPlus = 0;
				
				while($data=$req->fetch()) {
					$from = new DateTime($data['DateNaissance']);
					$to   = new DateTime('today');
					$age = $from->diff($to)->y."</br>";
					if($age < 25){
						$nbFemmesMoins ++;
					}else if($age > 50){
						$nbFemmesPlus ++;						
					}else{
						$nbFemmesEntre ++;
					}
				}

?>

<html>
			<table border ="1" cellpadding="5" align="center">
				<tr>
					<th>Tranche d'âge	</th>
					<th>Nb Hommes	</th>
					<th>Nb Femmes	</th>
				</tr>
				<tr>
					<th>Moins de 25 ans	</th>
					<td><?php echo $nbHommesMoins; ?></td>
					<td><?php echo $nbFemmesMoins; ?></td>
				</tr>
				<tr>
					<th>Entre 25 et 50 ans 	</th>
					<td><?php echo $nbHommesEntre; ?></td>
					<td><?php echo $nbFemmesEntre; ?></td>
				</tr>
				<tr>
					<th>Plus de 50 ans	</th>
					<td><?php echo $nbHommesPlus; ?></td>
					<td><?php echo $nbFemmesPlus; ?></td>
				</tr>
			</table>
			
			</br>

			<?php
				$reqMed = $linkpdo->prepare("
					SELECT m.IdMedecin, m.Nom, m.Prenom, SEC_TO_TIME(sum(TIME_TO_SEC(r.Duree)))
					FROM Medecin m, Rendez_vous r
					WHERE r.IdMedecin = m.IdMedecin
					GROUP BY m.IdMedecin
				");

				$reqMed->execute();

				while($dataMed=$reqMed->fetch()) {
					echo "<p>".$dataMed[1].' '.$dataMed[2]." durées totale de consultations : ".$dataMed[3]." heures";
				}
			?>

			<p><a href='index.php'>Retour au menu principal</a>

</html>
