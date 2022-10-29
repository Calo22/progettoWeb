<!DOCTYPE html>
<html>
	<head>
		<title>Prenotazione</title>	
	</head>
	<body>
		<?php
			session_start();
			
			//raccolgo dati dalla form
			$sport = $_GET["sport"];
			$campo = $_GET["campo"];
			$data_ora = $_GET["data_ora"];
			
			$secondi_inseriti = strtotime($data_ora);
			
			if ($secondi_inseriti < time()) {
				echo "Prenotazione non valida. Inserisci una data successiva a quella attuale. Riprova cliccando ".
						"<a href='pag_prenotazione.php'>qui</a>";		
			}
			else {
			
				//connessione al database
				include "connection_db.php";
				
				
				$sql = "select Sport, Campo, dataOra from prenotazioni where Sport = '$sport' AND ".
						"Campo = '$campo' AND dataOra = '$data_ora' ";
				
				//invio comando
				$result = mysqli_query($conn, $sql);
				
				//conto il numero di record trovati all'interno della tabella dal comando appena inviato
				if (mysqli_num_rows($result) > 0)
				{
					echo "Campo occupato! Riprova cliccando ".
						"<a href='pag_prenotazione.php'>qui</a>";						
				}
				else
				{
					
					$user = $_SESSION['user'];
				
					$sql = "select idUtente from utenti where userName = '$user' ";
					$result = mysqli_query($conn, $sql);
					
					//mysqli_fetch_assoc restituisce un array associativo corrispondente alla riga caricata
					//nota: un array associativo è un array composto da elementi costituiti da CHIAVE => VALORE
					//in caso non ci siano più righe restituisce FALSE
					$record = mysqli_fetch_assoc($result);
					
					$sql = mysqli_prepare($conn, "INSERT INTO prenotazioni(Utente, Sport, Campo, dataOra)
                              VALUES (?, ?, ?, ?)");
		
					mysqli_stmt_bind_param($sql, 'iiis', $record["idUtente"], $sport, $campo, $data_ora);

					if (mysqli_stmt_execute($sql) === TRUE)
					{
						echo "Prenotazione avvenuta con successo. ";
					}
					else
					{
						echo "Errore: " . mysqli_error($sql);
					}
					
					echo "<br/><br/>";
					
					/*$sql = "insert into prenotazioni (Utente, Sport, Campo, dataOra) values (".
						"'$record[idUtente]', '$sport', '$campo', '$data_ora')";
				
					//esito di invio comando (query), se avvenuto correttamente o meno
					if (!mysqli_query($conn, $sql))
						echo "Registrazione fallita"; */
			
			
					echo "<a href='pag_prenotazione.php'> Nuova Prenotazione </a> <br />";
					echo "<a href='home_accesso.php'> Home </a>";
				}
				//chiudo la connessione
				mysqli_close($conn);
			}
		?>
			
	</body>
	
</html>