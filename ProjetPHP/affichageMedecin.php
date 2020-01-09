<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Medecins</title>
	</head>
	<body>
		<fieldset>
			<legend>Affichage des Medecins</legend>
		<?php
			try {
				$linkpdo = new PDO("mysql:host=localhost;dbname=cabinet medical", "root", "");
			} catch (Exception $e) {
				die ("Erreur : ".$e->getMessage());
			}
			
			$req=$linkpdo->prepare("
				SELECT m.IdMedecin, m.Nom, m.Prenom
				FROM Medecin m
				ORDER BY m.Nom, m.Prenom
			");
			
			$req->execute();
			
			while($data=$req->fetch()) {
				echo  $data['Nom'].' '.$data['Prenom']."<a href='modificationMedecin.php?IdMedecin="." ".$data['IdMedecin']."'>Modifier</a>"." "."<a href='suppressionMedecin.php?IdMedecin=".$data['IdMedecin']."'>Supprimer</a></br>";
			}
			?>
				<button onclick="window.location.href = 'ajoutMedecin.php';">Ajouter un medecin</button>
			<?php
			$req->closeCursor();
		?>
		<p><a href='index.php'>Retour au menu principal</a>
		</fieldset>
	</body>
</html>
