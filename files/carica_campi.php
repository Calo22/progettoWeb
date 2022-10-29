<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>	
<?php

	$conn = mysqli_connect("localhost", "root", "");
		
			if (!$conn)
			{
				echo "Connessione non riuscita";	
				echo "<a href='controlloSemplice.php'>clicca qui</a>";
			}
			else if (!mysqli_select_db($conn, "sito_web"))
				{
					echo "Impossibile aprire il database";
					echo "<a href='controlloSemplice.php'>clicca qui</a>";
				
				}
				
				//la seguente funzione "isset" verifica se la variabile è stata definita oppure no
				else if(isset($_POST['sport'])){
	$select = "SELECT * FROM campi WHERE ksSport=".$_POST['sport'];
	
	//invio comando
	$query = mysqli_query($conn, $select);
	?>

	<?php
	
		//la seguente mysqli_fetch_array restituisce un array corrispondente alla riga caricata, 
		//se non ci sono più righe restituisce FALSE
	while($campi=mysqli_fetch_array($query)){									
		?>
		<option value="<?=$campi['idCampo']?>"><?=$campi['nomeCampo']?></option>
		<?php
	}
	
	mysqli_close($conn);

	?>
	</select>
<?php	
}
?>
	</body>
</html>