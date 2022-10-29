<!DOCTYPE html>
<html>
	<head> </head>
	<body>
	
	<?php
		//raccolgo dati dalla form
		$user = $_POST["user"];
		$psw = $_POST["psw"];
		
		$conn = mysqli_connect("localhost", "root", "");
		
		if (!$conn)
		{
			echo "Connessione non riuscita.\n";	
			echo "<a href='home_ospite.html'>HOME</a>";
		}
		else if (!mysqli_select_db($conn, "sito_web"))
			{
				echo "Impossibile aprire il database.\n";
				echo "<a href='home_ospite.html'>HOME</a>";
				
			}
			else
			{	
				$sql = "select psw from utenti where userName = '$user'";
				$result_psw_encode = mysqli_query($conn, $sql);
				
				if (mysqli_num_rows($result_psw_encode) > 0)
				{
				
					$string_hash = mysqli_fetch_array($result_psw_encode);
					
					
					if (password_verify($psw, $string_hash['psw'])) 
					{
						session_start();
						$_SESSION['user'] = $user;
						echo "Credenziali corrette. Benvenuto $user! Puoi proseguire: ";
						echo "<a href='home_accesso.php'>clicca qui</a>";					
					}
					else
					{
						echo "Credenziali NON valide. Riprova: ";
						echo "<a href='home_ospite.html'>clicca qui</a>";										
					}
				}
				else
				{
					echo "Utente non trovato. ";
					echo "<a href='home_ospite.html'>clicca qui</a>";
				}
			}
		
	?>
	
	
	</body>

</html>