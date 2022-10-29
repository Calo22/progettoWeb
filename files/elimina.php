<html>
<head>
  <title>Elimina</title>
</head>

<body>
<?php session_start(); ?>
<?php
 
$conn = mysqli_connect("localhost", "root", "");

			if (!$conn)
			{
				echo "Connessione non riuscita\n";	
				echo "<a href='area_personale.php'> Torna all'area personale </a>";
			}
			else if (!mysqli_select_db($conn, "sito_web"))
				{
					echo "Impossibile aprire il database\n";
					echo "<a href='area_personale.php'> Torna all'area personale </a>";
				
				}
			else
				{

 					  
  $sql = "delete from prenotazioni " .
			 "where idPrenotazione='$_GET[idPrenotazione]'";
  
	//esito comando inviato
    if (!mysqli_query($conn, $sql))
		echo "Eliminazione fallita\n";
				}
  
  //chiudo la connessione
	mysqli_close($conn);

  print "<a href='area_personale.php'> Torna all'area personale </a>";
 
?>
</body>
</html>
