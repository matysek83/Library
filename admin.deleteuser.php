<?php
include_once 'include/session.start.inc.php';
?>
<!--metatagi, kodowanie, skrypt google analitics-->
<?php
include_once  'include/meta.inc.php';
?>

<title>PHP Library</title>

</head>
<body onload="zegar();">
	<div align="center">		
		<div id="kontener">
			<div id="panel">
				<div id="formularz"><?php include_once 'include/login.user.php'; ?>
		
				
				
				
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
		include_once 'include/middle.menu.inc.php';
		?>
		<!-- koniec div srodkowe menu-->
		
			<div id="zawartosc">
				<div id="gorna_czesc_zawartosci"></div>
				<div id="srodkowa_czesc_zawartosci">
					<div id="tekst">
<?php					
if (isset($_SESSION['logged']))
{
    if ($_SESSION['logged'] == 3)
    {
        connect();


        $choosedb = mysql_select_db("matys_baza");

        $user_id = filter_var($_GET['user_id'], FILTER_SANITIZE_NUMBER_INT);
        $query = "DELETE FROM users
                WHERE
                user_id = $user_id

            ";

        $result = mysql_query($query) or die(mysql_error());
        if ($result)
        {
            echo "You have delete entry: ".$user_id;
        }
        else echo "Delete entry error! ID: $user_id";
        disconnect();
    }else echo "Site not exists";
}

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
