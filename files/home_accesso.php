<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>
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
			#griglia {
				padding: 0;
				margin: 0;
			}
			#griglia > img {
				border: 2px solid #333333;
				display: inline-block;
				margin: 10px;
			}
			#container {
				margin:0 auto;
				text-align: center;
			}
			img {
				width: 27%;	
				height: 250px;
			}

		</style>
		<script type="text/javascript" src="home.js"></script>		
	</head>
	<body>
		<header>
			<a href="home_accesso.php"><h1>A TUTTO SPORT!</h1></a>
		</header>
		<nav> 
			<a href="pag_prenotazione.php">PRENOTA IL TUO CAMPO</a> 
			<a href="area_personale.php">Area Personale</a>
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
		<section id="container">
			<figure id="griglia">
				<img src="images/calcetto.jpg" alt="Campo da calcio a 5" id="img1" />
				<img src="images/basket.jpeg" alt="Campo da basket" id="img2" />
				<img src="images/tennis.jpg" alt="Campo da tennis" id="img3" />
			</figure>
		</section>
	</body>
</html>