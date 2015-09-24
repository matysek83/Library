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
    echo "<form method=post action='' name='form'>";
    echo "Old password: <input type='password' name='oldpassword'><br>";
    echo "New password: <input type='password' name='newpassword'><br>"; 
    echo "New password: <input type='password' name='newpassword1'><br>"; 
    echo "<input type='submit' value=' Send ' >";
    echo "</form>";

    connect();
    if (isset($_POST['oldpassword']) && isset($_POST['newpassword']) && isset($_POST['newpassword1']))
    {
        if (!empty($_POST['oldpassword']) && !empty($_POST['newpassword']) && !empty($_POST['newpassword1']))
        {
            $newpassword = filter_var($_POST['newpassword'], FILTER_SANITIZE_STRING);
            $oldpassword = filter_var($_POST['oldpassword'], FILTER_SANITIZE_STRING);
            $salt = "grogn540gnobvn5re5njy";
            $newpassword = hash("sha512", $salt.$oldpassword);
            $oldpassword = hash("sha512", $salt.$oldpassword);

            $selectdb = mysql_select_db("matys_baza");
            $query = "SELECT password FROM users WHERE password = '$oldpassword'";
            $result = mysql_query($query) or die (mysql_error());
            if ($result)
            {
                $query = "UPDATE users SET password = '$newpassword' WHERE password = '$oldpassword'";
                $result = mysql_query($query) or die (mysql_error());
                if ($result)
                {
                    echo "you have changed password";    
                }
                else unset($_POST['oldpassword']);
            }
            else echo "wrong old password";
        }
    }
}
else echo "You must be logged"
                                            
                                            
                                            
                                            
                                            
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
