<!DOCTYPE html>
<html>
	<head>
		<title>Registrazione</title>	
	</head>
	<body>
		<?php
			/*ricezione dei dati inviati dalla form tramite il metodo post
			e inserimento degli stessi nelle variabili */
			$nome = $_POST["nome"];
			$cognome = $_POST["cognome"];
			$data = $_POST["nascita"];
			$residenza = $_POST["residenza"];
			$via = $_POST["via"];
			$user = $_POST["user"];
			$psw = $_POST["psw"];
			$r_psw = $_POST["psw_repeat"];
			
			//verifica se le password inserite nella registrazione coincidono 
			if ($r_psw != $psw)
			{
				echo "<script type='text/javascript'> window.alert('Le password devono coincidere.')".
					"</script>";
				echo "<a href='registrazione.html'>Torna a \"Registrazione\"</a>";
			}
			else
			{			
				//connessione al database
				include "connection_db.php";
				
				// Securing password using password_hash
				$secure_pass = password_hash($psw, PASSWORD_BCRYPT);
		
				$sql = mysqli_prepare($conn, "INSERT INTO utenti(nome, cognome, dataNascita, cittaResidenza, via, userName, psw)
                              VALUES (?, ?, ?, ?, ?, ?, ?)");
		
				mysqli_stmt_bind_param($sql, 'sssssss', $nome, $cognome, $data, $residenza, $via, $user, $secure_pass);

				if (mysqli_stmt_execute($sql) === TRUE)
				{
					echo "Registrazione nuovo utente avvenuta con successo. ";
				}
				else
				{
					echo "Errore: " . mysqli_error($sql);
				}
				
				echo "<br/><br/>";

		
				/*$sql = "insert into utenti (nome, cognome, dataNascita, cittaResidenza, via, userName, psw) values (".
					"'$nome', '$cognome', '$data', '$residenza', '$via', '$user', '$secure_pass')";
				
				//esito di invio comando (query), se avvenuto correttamente o meno
				if (!mysqli_query($conn, $sql))
					echo "Registrazione fallita"; */
			
				//chiudo la connessione
				mysqli_close($conn);
			
				echo "<a href='home_ospite.html'> Home </a>";
			}
				
		?>
			
	</body>
	
</html>