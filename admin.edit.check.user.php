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
if (isset($_POST['user_id']) && isset($_POST['login']) && isset($_POST['email']) && isset($_POST['permissions']) && isset($_GET['user_id']))
{
    if (!empty($_POST['user_id']) && !empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['permissions']) && !empty($_GET['user_id'])) 
    {
        
        $db_h = connect();
        
         
        $user_id = filter_var($_POST['user_id'], FILTER_SANITIZE_STRING);
        $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);        
        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $permissions = filter_var($_POST['permissions'], FILTER_SANITIZE_STRING);
        $user_id_original = filter_var($_GET['user_id'], FILTER_SANITIZE_STRING);
    
    
    $query = "UPDATE users SET 
            user_id = $user_id,
            login = '$login',
            email = '$email',
            permissions = '$permissions'  
                WHERE user_id = $user_id_original
            
            "; 
    $result = mysqli_query($db_h, $query) or die(mysqli_error($db_h));  
    if ($permissions == 1)
    $permissions = "not registered";
    else if ($permissions == 2)
    $permissions = "registered";
    else if ($permissions == 3)
    $permissions = "admin";
        
    echo "USER ID: $user_id<br> LOGIN: $login <br> EMAIL: $email<br> PERMISSIONS: $permissions";                                        
   }else echo "dupa1";
}else echo "dupa2";
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
