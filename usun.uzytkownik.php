<?
include_once 'include/start.sesji.inc.php';
?>
<!--metatagi, kodowanie, skrypt google analitics-->
<?php
include "include/meta.inc.php";
?>

<title>Pasje.biz - Programowanie C++, Turbo Pascal, PHP, Systemy UNIX - FreeBSD</title>

</head>
<body onload="zegar();">
	<div align="center">		
		<div id="kontener">
			<div id="panel">
				<div id="formularz"><?include_once 'include/logowanie.inc.php';	?>	
		

				
				
				
				</div>
				<div id="zegar">
			
				<script type="text/javascript" src="script.js"></script>
								
				</div>
			</div>
			<div id="gorna_czesc_kontenera">
				
			
			
	    	</div>	
		<!-- koniec div gorna czesc kontenera -->
		
		<!--środkowe menu-->
		<?php
		include "include/srodkowe.menu.inc.php";
		?>
		<!-- koniec div srodkowe menu-->
		
			<div id="zawartosc">
				<div id="gorna_czesc_zawartosci"></div>
				<div id="srodkowa_czesc_zawartosci">
					<div id="tekst">
						<?php

						
						polaczenie();


						$wyborbazy = mysql_select_db("matys_baza");

						$usun_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
						$query = "DELETE IGNORE FROM users
								WHERE
								id = '$usun_id'

							";
						echo "usunięto wpis o id: ".$usun_id;
						mysql_query($query) or die(mysql_error());

						zamknij_baze();
						error_reporting(E_ALL);
						?>
					</div>
					
					
				</div>
				<!--koniec div srodkowa czesc zawartosci-->
				<div id="dolna_czesc_zawartosci"></div>
			
			</div>
		
		<div id="stopka">
			&copy; 2015  created by Matys
			
		</div>
		
		
	  </div>
	  <!-- koniec div kontener-->
	</div>
	
	
		
		
	</body>
</html>
