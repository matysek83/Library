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
    
    $db_h = connect();
    include_once ("captcha/securimage/securimage.php");
    {
?>    

    <form method=post action='' name='form'>
    Old password: &nbsp;&nbsp;<input type='password' name='oldpassword'><br>
    New password: <input type='password' name='newpassword'><br>
    New password: <input type='password' name='newpassword1'><br>
    <img src='captcha/securimage/securimage_show.php' id='image' align='absmiddle' /> <br>
    code: <input type='text' name='code' size='10' maxlength='6'>
    <a href="change.password.php" onclick="document.getElementById('captcha').src = 'captcha/securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>
    <input type='submit' value=' Send ' >
    </form>
 <?php
    }
    $user_id = $_SESSION['user_id'];
    $query = "SELECT password FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($db_h, $query) or die(mysqli_error($db_h));
    $row = mysqli_fetch_assoc($result);
    $oldpassword_from_db = $row['password'];

    
    if (isset($_POST['oldpassword']) && isset($_POST['newpassword']) && isset($_POST['newpassword1']) && isset($_POST['code']))
    {
        if (!empty($_POST['oldpassword']) && !empty($_POST['newpassword']) && !empty($_POST['newpassword1']) && !empty($_POST['code']))
        {
            if ($_POST['newpassword'] == $_POST['newpassword1'])
            {
                $img = new Securimage();
                $valid = $img->check($_POST['code']);
                if ($valid == FALSE) {
                  die('Wrong captcha code!');             
                }
                
                $oldpassword = filter_var($_POST['oldpassword'], FILTER_SANITIZE_STRING);
                $salt = "grogn540gnobvn5re5njy";

                $oldpassword = hash("sha512", $salt.$oldpassword);
                if ($oldpassword == $oldpassword_from_db)
                {
                    $newpassword = filter_var($_POST['newpassword'], FILTER_SANITIZE_STRING);
                    $newpassword = hash("sha512", $salt.$newpassword);
                    $query = "SELECT password FROM users WHERE password = '$oldpassword'";
                    $result = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
                    if ($result)
                    {
                        $query = "UPDATE users SET password = '$newpassword' WHERE user_id = $user_id";
                        $result = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
                        if ($result)
                        {
                            echo "you have changed password";    
                        }
                        else unset($_POST['oldpassword']);
                    }
                }else echo "wrong old password";
            }else echo "new passwords are different";
        }
    } 

}else echo "You must be logged";
                                            
                                            
                                            
                                            
                                            
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
