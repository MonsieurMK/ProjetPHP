<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Ajout Medecins</title>
	</head>
	<body>
		<fieldset>
		<legend>Ajout de nouveau Medecins</legend>
			<form action = "authentification.php" method = "post">
				<p>Identifiant : <input type = "text" name = "identifiant" required /></p>
				<p>Mot de passe : <input type = "password" name = "mdp" required /></p>
				<input type = "submit" value = "Se connecter"/></p>
				<?php
                    $identifiant = 'abcdef';
                    $mdp = 'azertyui';
                    if (isset($_POST['identifiant'])) {
                        if ($_POST['identifiant'] == $identifiant && $_POST['mdp'] == $mdp) {
                            session_start();
                            $_SESSION['identifiant'] = $_POST['identifiant'];
                            header("Location: index.php"); 
                        } else {
                            echo "<p> Mot de passe ou identifiant incorrect</p>";
                        }
                    }
                ?>
			</form>
		</fieldset>
	</body>
</html>
