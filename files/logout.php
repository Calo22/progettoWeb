<html>
  <head>
    <title>Pagina di Redirect</title>
    <meta http-equiv="refresh" content="5;URL=home_ospite.html">
  </head>
  <body>
	<?php
		session_start();
		//termine della sessione corrente
		session_destroy();
	?>
    <p>
	LOGOUT EFFETTUATO!<br />
    Tra 5 secondi sarai reindirizzato automaticamente alla home del sito.<br />
    Se non vuoi aspettare <a href="home_ospite.html">clicca qui</a>.
    </p>
  </body>
</html>