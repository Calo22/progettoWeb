<!DOCTYPE HTML>

<html>
<head>
  <title>Modifica prenotazione</title>
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
			header a{
				color: orange;
				text-decoration: none;
			}
			nav {
				border: 1px solid;
				line-height: 35px;
				text-align: center;
				padding: 50px;
				padding-top: 10px;
				padding-left: 300px;
			}
			nav a {
				color: white;
				text-decoration: none; 
				font-weight: bold;
				font-size: 18px;		
				margin-right: 60px;
			}
			section {
				color: white;
				font-weight: bold;
			}
			section h1 {
				text-align: center;
				font-family: "Lucida Console";
				font-size: 40px;
				color: red;
				text-decoration: underline;
			}
			table {
				margin: auto;
				font-weight: bold;
			}
			.bottone {
				border: 2px solid red;
				background-color: blue;
				color: white;
				font-weight: bold;
				margin-top: 10px;
				float: right;
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
			#bottone1 {
				border: 2px solid red;
				background-color: blue;
				color: white;
				font-weight: bold;				
				padding: 2px;
				padding-left: 4px;
				padding-right: 4px;
				text-align: center;
			}				
		</style>
</head>

<body>
		<script type="text/javascript" src="ajax_menu.js"></script>		


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
 
  //leggo dal db i dati dell'utente
  $sql = "select * from prenotazioni where idPrenotazione='$_GET[idPrenotazione]'";
  
  //invio comando
  $result = mysqli_query($conn, $sql);

  //mysqli_fetch_assoc restituisce un array associativo corrispondente alla riga caricata
  //nota: un array associativo è un array composto da elementi costituiti da CHIAVE => VALORE
  //in caso non ci siano più righe restituisce FALSE
  $record = mysqli_fetch_assoc($result);
  
  $sport = $record["Sport"];
  $campo = $record["Campo"];
  $data_ora = $record["dataOra"];
  $idPrenotazione = $record["idPrenotazione"];
				}
 
?>

		<header>
			<a href="home_accesso.php"><h1>A TUTTO SPORT!</h1></a>
		</header>
		<nav> 
			<a href="area_personale.php">Area Personale</a>
			<?php 
				//login effettuato, sessione aperta
				echo "<div id='utente'> Utente: $_SESSION[user] "; 
			?>
			<form action="logout.php">
				<input type="submit" id="bottone1" value="Logout"/>
			</form>
			</div>
		</nav>
<section>
<h1>Aggiornamento prenotazione</h1>
<form method="get" class="formquery" id="form" action="eModifica.php" name="form">
	<table>
		<tr>
	<td class="titolo">Scegli lo sport</td>
	<td class="riga">									
		<?php

			$select = "SELECT * FROM sport";
			$query = mysqli_query($conn, $select);
				
		?>
		<select name="sport" id="sport" onchange="carica_campi(this.value)" class="select1" required>
			<option value=""></option>
		<?php
		
		//la seguente mysqli_fetch_array restituisce un array corrispondente alla riga caricata, 
		//se non ci sono più righe restituisce FALSE
		while($sport = mysqli_fetch_array($query)){									
			?>
			<option value="<?=$sport['idSport']?>"><?=$sport['nomeSport']?></option>
			<?php
		}
		
		mysqli_close($conn);

		?>
		</select>
	</td>	
	</tr>
	
	<tr>
	
	<td class="titolo">Scegli il campo</td>
	<td> <select name="campo" id="campo">
			<option value=""></option>
		<?php //qui verrà stampato il contenuto elaborato dal file "carica_campi.php" ?>		
		</select>
	</td>
	</tr>
	
	<tr>
	<td>Scegli un giorno e un'ora</td>
	<td>
		<input type="datetime-local" name="data_ora" id="data_ora" required />
	</td>
	</tr>
	
		<input type="hidden" name="idPrenotazione" value="<?php /* valore ID da passare a eModifica.php */ echo $idPrenotazione; ?>"> 
	
	<tr>
		<td></td>
		<td> <input id="aggiorna" value="AGGIORNA" type="submit" name="aggiorna" class="bottone"> </td>
	</tr>
	
	</table>
</form>
</section>
</body>
</html>
