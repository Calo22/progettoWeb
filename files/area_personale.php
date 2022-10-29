<!DOCTYPE html>
<html>
	<head>
		<title>Area personale</title>
		<style>
			body {
				background-color: blue;
			}
			header {
				height: 150px;
				text-align: center;
				font-family: "Comic Sans MS", cursive, sans-serif;
				font-size: 250%;
			}
			header a {
				color: orange;
				text-decoration: none;
			}
			nav {
				border: 1px solid;
				line-height: 35px;
				text-align: left;
				padding: 50px;
				padding-top: 10px;
			}
			nav a {
				color: white;
				text-decoration: none; 
				font-weight: bold;
				font-size: 18px;		
				margin-right: 60px;
			}
			nav a:first-child {
				background-color: red;
				padding: 10px;
				margin-left: 27px;

			}
			#utente {
				color: orange;
				font-weight: bold;
				text-align: center;
				border: 1px solid;
				margin-right: 27px;
				float: right;
				padding-left: 20px;
				padding-right: 20px;
			}
			#bottone {
				border: 2px solid red;
				background-color: blue;
				color: white;
				font-weight: bold;				
				padding: 2px;
				padding-left: 4px;
				padding-right: 4px;
				text-align: center;
			}		
			section h2 {
				text-align: center;
				font-family: "Lucida Console";
				font-size: 40px;
				color: red;
				text-decoration: underline;
			}
			section h3 {
				text-align: center;
			}
			table {
				margin-left: auto; 
				margin-right: auto;
				font-weight: bold;
				border: 5px solid blue;
			}
			table th {
				text-decoration: underline;
			}
			table td{
				padding-left: 20px;
				padding-right: 20px;
			}
			.bottoni {
				border: 2px solid red;
				background-color: blue;
				color: white;
				font-weight: bold;				
			}
		</style>
	</head>
	
	<body>
		<header>
			<a href="home_accesso.php"><h1>A TUTTO SPORT!</h1></a>
		</header>
		<nav> 
			<a href="pag_prenotazione.php">PRENOTA IL TUO CAMPO</a> 
			<?php 
				//login effettuato, sessione aperta
				session_start(); 
				echo "<div id='utente'> Utente: $_SESSION[user] "; 
			?>
			<form action="logout.php">
				<input type="submit" id="bottone" value="Logout"/>
			</form>
			</div>
		</nav>
		<?php
			$user = $_SESSION['user'];
			
			$conn = mysqli_connect("localhost", "root", "");
		
			if (!$conn)
			{
				echo "Connessione non riuscita\n";	
				echo "<a href='home_accesso.php'>HOME</a>";
			}
			else if (!mysqli_select_db($conn, "sito_web"))
				{
					echo "Impossibile aprire il database\n";
					echo "<a href='home_accesso.php'>HOME</a>";
				
				}
				else
				{	
					$sql = "select idPrenotazione, nomeSport, nomeCampo, posizione, dataOra from sport, prenotazioni, campi, utenti ".
							"where idSport = Sport and idCampo = Campo and idUtente = Utente and userName = '$user' and dataOra > NOW()";
					
					echo "<section> <h2>Prenotazioni in corso</h2>";
					
					
					//invio il comando
					$result = mysqli_query($conn, $sql);			
					
					
					if (mysqli_num_rows($result) > 0)						
						echo "<table> <tr> <td></td> <td></td> <th>ID</th> <th>SPORT</th> <th>CAMPO</th>".
							"<th>LUOGO</th> <th>DATA E ORARIO</th></tr>";
					else
						echo "<h3>Non ci sono prenotazioni in corso</h3>";
						
					//mysqli_fetch_assoc restituisce un array associativo corrispondente alla riga caricata
					//nota: un array associativo è un array composto da elementi costituiti da CHIAVE => VALORE
					//in caso non ci siano più righe restituisce FALSE
					while ($record = mysqli_fetch_assoc($result)) 
					{
						
						echo "<tr>";
						echo "<td> <form method='get' name='elimina' action='elimina.php'>".
							 "<input type='hidden' name='idPrenotazione' value='$record[idPrenotazione]'>".
							 "<input value='ELIMINA' type='submit' name='elimina' class='bottoni'> </form> </td>";
						echo "<td> <form method='get' name='modifica' action='modifica.php'>".
							 "<input type='hidden' name='idPrenotazione' value='$record[idPrenotazione]'>".
							 "<input value='MODIFICA' type='submit' name='modifica' class='bottoni'> </form> </td>";
						
						//la seguente istruzione stampa a video i valori prelevati dal database
						foreach ($record as $campo)
							echo "<td> $campo </td>";
						
						
						echo "</tr> \n";
					}
					echo "</table>";
					
					echo "<hr />";
					
					$sql = "select idPrenotazione, nomeSport, nomeCampo, posizione, dataOra from sport, prenotazioni, campi, utenti ".
							"where idSport = Sport and idCampo = Campo and idUtente = Utente and userName = '$user' and dataOra < NOW()";
					
					echo "<h2>Prenotazioni scadute</h2>";
					
					//invio comando
					$result = mysqli_query($conn, $sql);	
					
					if (mysqli_num_rows($result) > 0)
						echo "<table> <tr> <td></td> <td></td> <th>ID</th> <th>SPORT</th> <th>CAMPO</th>".
							"<th>LUOGO</th> <th>DATA E ORARIO</th></tr>";
					else
						echo "<h3>Non ci sono prenotazioni passate</h3>";
							
					//mysqli_fetch_assoc restituisce un array associativo corrispondente alla riga caricata
					//nota: un array associativo è un array composto da elementi costituiti da CHIAVE => VALORE
					//in caso non ci siano più righe restituisce FALSE
					while ($record = mysqli_fetch_assoc($result)) 
					{
						echo "<tr>";
						echo "<td></td> <td></td>";
						
						//la seguente istruzione stampa a video i valori prelevati dal database
						foreach ($record as $campo)
							echo "<td> $campo </td>";
						
						
						echo "</tr> \n";
					}
					echo "</table> </section>";
	
				}		

			mysqli_close($conn);
			

		?>
	</body>

</html>