<!DOCTYPE html>
<html>
	<head>
		<title>Prenotazione</title>
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
				text-align: left;
				padding: 50px;
				padding-top: 10px;
			}
			nav a {
				color: white;
				text-decoration: none; 
				font-weight: bold;
				font-size: 18px;		
				margin-left: 27px;
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
		

		<header>
			<a href="home_accesso.php"><h1>A TUTTO SPORT!</h1></a>
		</header>
		<nav> 
			<a href="area_personale.php">Area Personale</a>
			<?php 
				//login effettuato, sessione aperta
				session_start(); 
				echo "<div id='utente'> Utente: $_SESSION[user] "; 
			?>
			<form action="logout.php">
				<input type="submit" id="bottone1" value="Logout"/>
			</form>
			</div>
		</nav>
<section>
<h1>Prenotazione</h1>
<form method="get" class="formquery" id="form" action="reg_prenotazione.php" name="form">
	<table>
		<tr>
	<td class="titolo">Scegli lo sport</td>
	<td class="riga">								
		<?php
			$conn = mysqli_connect("localhost", "root", "");
		
			if (!$conn)
			{
				echo "Connessione non riuscita.\n";	
				echo "<a href='home_accesso.php'>HOME</a>";
			}
			else if (!mysqli_select_db($conn, "sito_web"))
				{
					echo "Impossibile aprire il database.\n";
					echo "<a href='home_accesso.php'>HOME</a>";
				
				}
				else
				{
					$select = "SELECT * FROM sport";
					
					//invio il comando
					$query = mysqli_query($conn, $select);
				}
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
		
	<tr>
		<td></td>
		<td> <input type="submit" value="PRENOTA!" class="bottone"/> </td>
	</tr>
	</table>
</form>
</section>
	</body>
</html>
