<!DOCTYPE HTML>

<html>
<head>
  <title>Registra nel DB</title>
</head>

<body>
<?php session_start(); ?>
<?php
     
  //raccolgo i dati dalla form
	$sport = $_GET["sport"];
	$campo = $_GET["campo"];
	$data_ora = $_GET["data_ora"];
	$idPrenotazione = $_GET["idPrenotazione"];
  
	//connessione al database
	include "connection_db.php";
	
	$sql = "select Sport, Campo, dataOra from prenotazioni where Sport = '$sport' AND ".
						"Campo = '$campo' AND dataOra = '$data_ora' ";
						
				//invio comando
				$result = mysqli_query($conn, $sql);
				
				//conto il numero di righe trovate nella tabella
				if (mysqli_num_rows($result) > 0)
				{
					echo "Campo occupato! \n";						
				}
				else
				{
				
					$sql = mysqli_prepare($conn, "UPDATE prenotazioni SET Sport=?, Campo=?, " .
							 "dataOra=? WHERE idPrenotazione='$idPrenotazione'");
        
					mysqli_stmt_bind_param($sql, 'iis', $sport, $campo, $data_ora);
				
					if (mysqli_stmt_execute($sql) === TRUE)
					{
						echo "Aggiornamento della prenotazione avvenuto con successo. ";
					}
					else
					{
						echo "Error: " . mysqli_error($sql);
					}
 					  
					echo "<br/><br/>";
					
				 /* $sql = "update prenotazioni set Sport='$sport', Campo='$campo', " .
							 "dataOra='$data_ora' " .
							 "where idPrenotazione='$idPrenotazione'";

					//esito comando inviato
				  if (!mysqli_query($conn, $sql))
					echo "Aggiornamento fallito <br />";
				  else
					 echo "Modifica effettuata con successo.\n"; */
	
				}
  //chiudo la connessione
  mysqli_close($conn); 

  echo "<a href='area_personale.php'> Torna all'area personale </a>";
 
?>
</body>
</html>
