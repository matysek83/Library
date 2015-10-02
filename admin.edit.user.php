<?php
include_once 'include/session.start.inc.php';
?>
<!--metatagi, kodowanie, skrypt google analitics-->
<?php
include "include/meta.inc.php";
require_once 'include/login.to.base.php';
?>

<title>PHP Library</title>

</head>
<body onload="zegar();">
	<div align="center">		
		<div id="kontener">
			<div id="panel">
				<div id="formularz">
                                <?php include_once 'include/login.user.php';	?>
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
						<?php
							$db_h = connect();
							$edit_id = $_GET['user_id'];
							$query = "SELECT * from users WHERE user_id=$edit_id";
							$result = mysqli_query($db_h, $query) or die(mysqli_error($db_h));
							mysqli_query($db_h, $query) or die(mysqli_error($db_h));

							echo "<table class='fixed' bgcolor=#EEEEEE border=1 width='880'>
                                                         <tr>
							<th>ID</th>
							<th>Login</th>
							<th>E-mail</th>
							<th>Permissions</th>
							<th>Date added entry</th>
							</tr>";

							
							$row = mysqli_fetch_assoc($result);
								if ($row['permissions'] == 1)
								$row['permissions'] = "not registered";
								else if ($row['permissions'] == 2)
								$row['permissions'] = "registered";
								else if ($row['permissions'] == 3)
								$row['permissions'] = "admin";

								
								echo "<tr align=center>";
                                                                echo "<col width='20px' />
                                                                    <col width='130px' />
                                                                    <col width='260px' />
                                                                     <col width='300px' />";
								echo "<td>".$row['user_id']."</td>";
								echo "<td>".$row['login']."</td>";
								echo "<td>".$row['email']."</td>";
								echo "<td>".$row['permissions']."</td>";
								echo "<td>".$row['date_added_entry']."</td>";
								
							
							$user_id = $row['user_id'];
							$login = $row['login'];
							$email = $row['email'];
							$permissions = $row['permissions'];


							echo "<form method='post' action='admin.edit.check.user.php?user_id=$user_id'>;
							<tr>
							<td style='min-width:50px;'><input type='text' name='user_id' size='30' value='$user_id' maxlength='40'/></td>
							<td><input type='text' name='login' size='30' maxlength='40' value='$login'/></td>
							<td><input type='text' name='email' size='40' maxlength='50' value='$email'/></td>";
							echo "<td><input type=radio name=permissions value=1 ";
                                                        if ($permissions=="not registered") echo ' checked'; 
                                                        echo "/>not registered";
							echo "<input type=radio name=permissions value=2";
                                                        if ($permissions=="registered") echo ' checked'; 
                                                        echo "/>registered";
							echo "<input type='radio' name='permissions' value=3";
                                                        if ($permissions=="admin") echo ' checked';      
                                                        echo "/>admin</td>";
							echo "</tr></table>";
							echo "<input type='submit' id='przycisk' name='Add Entry' value='Add Entry'></form>";
                                                        disconnect();;        
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
