<?
include_once 'include/session.start.inc.php';
?>
<!--metatagi, kodowanie, skrypt google analitics-->
<?php
include "include/meta.inc.php";
require_once 'include/logowanie.do.bazy.php';
?>

<title>Pasje.biz - Programowanie C++, Turbo Pascal, PHP, Systemy UNIX - FreeBSD</title>

</head>
<body onload="zegar();">
	<div align="center">		
		<div id="kontener">
			<div id="panel">
				<div id="formularz">
                                <?include_once 'include/logowanie.inc.php';	?>
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
		include "include/middle.menu.inc.php";
		?>
		<!-- koniec div srodkowe menu-->
		
			<div id="zawartosc">
				<div id="gorna_czesc_zawartosci"></div>
				<div id="srodkowa_czesc_zawartosci">
					<div id="tekst">
						<?
							polaczenie();
							$wyborbazy = mysql_select_db("matys_baza") or die (mysql_error());
							$edit_id = $_GET['id'];
							$query = "SELECT * from users WHERE id='$edit_id'";
							$result = mysql_query($query) or die(mysql_error());
							mysql_query($query) or die(mysql_error());

							echo "<table class='fixed' bgcolor=#EEEEEE border=1 width='880'>
                                                         <tr>
							<th>ID</th>
							<th>Login</th>
							<th>E-mail</th>
							<th>Uprawnienia</th>
							<th>Data rejestracji</th>
							</tr>";

							
							$row = mysql_fetch_assoc($result);
								if ($row['uprawnienia'] == 1)
								$row['uprawnienia'] = "niezajerestrowany";
								else if ($row['uprawnienia'] == 2)
								$row['uprawnienia'] = "zajerestrowany";
								else if ($row['uprawnienia'] == 3)
								$row['uprawnienia'] = "admin";

								
								echo "<tr align=center>";
                                                                echo "<col width='20px' />
                                                                    <col width='130px' />
                                                                    <col width='260px' />
                                                                     <col width='300px' />";
								echo "<td>".$row['id']."</td>";
								echo "<td>".$row['login']."</td>";
								echo "<td>".$row['email']."</td>";
								echo "<td>".$row['uprawnienia']."</td>";
								echo "<td>".$row['data_dodania_wpisu']."</td>";
								
							
							$id = $row['id'];
							$login = $row['login'];
							$email = $row['email'];
							$uprawnienia = $row['uprawnienia'];


							echo "<form method='post' action='edit.sprawdzenie.uzytkownika.php?id=$id'>;
							<tr>
							<td style='min-width:50px;'><input type='text' name='id' size='30' value='$id' maxlength='40'/></td>
							<td><input type='text' name='login' size='30' maxlength='40' value='$login'/></td>
							<td><input type='text' name='email' size='40' maxlength='50' value='$email'/></td>
							<td><input type='radio' name='uprawnienia' value=1/>niezajerestrowany
							<input type='radio' name='uprawnienia' value=2/>zarejestrowany
							<input type='radio' name='uprawnienia' value=3/>admin</td>
							</tr></table>
							<input type='submit' id='przycisk' name='Dodaj'></form>";
					
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
